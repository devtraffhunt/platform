<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SystemDep;
use App\DepPromo;
use App\User;
use App\ActivePromo;
use App\Setting;
use App\Status;
use Auth;
use App\Payment;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->redis = Redis::connection();
	}

	
	public function statusBonus($now, $need_plus, $user_id)
	{
		$now = $now;
		$need_plus = $need_plus;
		for ($i = $now; $i < $need_plus; $i++) {
			$st_id = $i + 1;
			$status = Status::where('id', $st_id)->first();
			$bonus = $status->bonus;
			$user = User::where('id', $user_id)->first();
			$user->balance += $bonus;
			$user->status += 1;
			$user->save();
		}
	}

	public function result()
	{
		$setting = Setting::first();

		$unique_id = $_GET['unique_id'];
		$sign = $_GET['sign'];
		$description = $_GET['description'];
		$amount = $_GET['amount'];

		$my_token = $setting->gamepay_api_key;
		$my_shop_id = $setting->gamepay_shop_id;
		$amount = number_format($amount, 2, '.', '');
		$my_sign = hash('sha256', "{$unique_id}:{$amount}:{$my_token}:{$my_shop_id}");

		if ($sign == $my_sign) {
			$payment_count = Payment::where('transaction', $unique_id)->count();
			if ($payment_count == 0) {
				die('Ошибка');
			}
			$pay = Payment::where('transaction', $unique_id)->first();
			if ($pay->status == 1) {
				die('Ошибка');
			}
			$pay->status = 1;

			$percent = $pay->percent;
			$amount = $amount + ($amount * $percent / 100);
			$user_id = $pay->user_id;

			$user = User::where('id', $user_id)->first();
			$ref_id = $user->ref_id;

			$pay->afterpay = $user->balance + $amount;
			$pay->save();

			$user_status = $user->status;
			$user_deps = $user->deps + $amount;

			// $now_status = Status::where('deposit', '>=', $amount)->where('deposit', '<', $amount)->orderBy('id', 'desc')->first();
			$now_st = $user_status;
			$max_id = Status::max('id');
			if ($max_id != $user_status) {
				$statuses = Status::where('id', '>', $user_status)->orderBy('id', 'asc')->get();
				foreach ($statuses as $st) {
					if ($user_deps >= $st->deposit) {
						$now_st = $st->id;
					}
				}
			}

			$update_status = $now_st - $user_status;
			if ($update_status > 0) {
				self::statusBonus($user_status, $now_st, $user_id);
			}

			$user = User::where('id', $user_id)->first();
			if ($user->deps == 0 and $user->balance > 10) {
				$user->bonus_up = 1;
			} else {
				$user->bonus_up = 0;
			}
			$user->balance += $amount;
			$user->deps += $amount;
			if ($user->sum_to_withdraw < 0) {
				$user->sum_to_withdraw = 0;
			}
			$user->sum_to_withdraw += ($amount * 3 - $amount);
			$user->save();

			if ($ref_id > 0) {
				$user_ref = User::where('id', $ref_id)->first();
				$percent_ref = $user_ref->ref_coeff;

				$balance_ref = $user_ref->balance + ($amount * $percent_ref / 100);
				$user_ref->profit += ($amount * $percent_ref / 100);
				// $user_ref->balance = $balance_ref;
				$user_ref->balance_ref += ($amount * $percent_ref / 100);
				$user_ref->save();
			}
		} else {
			die("Недействительная подпись");
		}
	}

	public function requestGamePay($type, $params)
	{
		$url = 'https://oplatalift.site/api/' . $type;

		$result = file_get_contents($url, false, stream_context_create(array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-type: application/x-www-form-urlencoded',
				'content' => http_build_query($params)
			)
		)));

		$response = json_decode($result, true);
		return $response;
	}
	public function checkStatus(Request $r)
	{
		$id = $r->id;
		$setting = Setting::first();
		$params = array(
			'vip_id' => 4,
			'order_id' => $id,
			'token' => $setting->gamepay_api_key
		);
		$resp = self::requestGamePay('checkStatus', $params);
		$status = $resp['data']['status'];
		if ($status == 0) {
			return response(['success' => false, 'mess' => 'Перевод не найден']);
		}
		return response(['success' => true]);
	}
	public function go(Request $r)
	{
		$sum = $r->sum;
		$system = $r->system;
		$promo = $r->promo;

		if (!is_numeric($sum)) {
			return response(['success' => false, 'mess' => 'Please enter the correct top-up amount']);
		}

		if (\Auth::guest()) {
			return response(['success' => false, 'mess' => 'Log in']);
		}

		$user = \Auth::user();
		if ($user->type_balance == 1) {
			return response(['success' => false, 'mess' => 'Switch to real balance']);
		}

		$countSystemDep = SystemDep::where('id', $system)->count();

		if ($countSystemDep == 0) {
			return response(['success' => false, 'mess' => 'Error']);
		}

		//if($user->admin == 3) return response(['success' => false, 'mess' => 'Ошибка']);

		$systemDep = SystemDep::where('id', $system)->first();
		$minDep = $systemDep->min_sum;
		$psDep = $systemDep->ps;
		$number_ps = $systemDep->number_ps;
		$img = $systemDep->img;

		if ($sum < $minDep) {
			return response(['success' => false, 'mess' => "Minimum deposit amount {$minDep} INR."]);
		}

		$percent = 0;

		if ($promo != '') {
			$deppromo_count = DepPromo::where('name', $promo)->count();
			if ($deppromo_count == 0) {
				return response(['success' => false, 'mess' => 'Promo code not found or expired']);
			}

			$promo_act_count = ActivePromo::where('promo', $promo)->where('user_id', $user->id)->count();
			/*if ($promo_act_count > 0) {
				return response(['success' => false, 'mess' => "You have already used this code"]);
			}*/
			$deppromo = DepPromo::where('name', $promo)->first();
			$start = $deppromo->start;
			$end = $deppromo->end;
			$active = $deppromo->active; //ALL
			$actived = $deppromo->actived;
			$percent = $deppromo->percent;
			$now_time = time();
			$start = strtotime($start);
			$end = strtotime($end);

			if ($actived == $active) {
				return response(['success' => false, 'mess' => 'Promo code not found or expired']);
			}

			if ($now_time < $start) {
				return response(['success' => false, 'mess' => 'Promo code will be available ' . date('d.m в H:i', $start)]);
			}


			if ($now_time > $end) {
				return response(['success' => false, 'mess' => 'Promo code not found or expired']);
			}

			$deppromo->actived += 1;
			$deppromo->save();

			ActivePromo::create(array(
				'promo' => $promo,
				'user_id' => $user->id,
				'type_promo' => 1,
				'promo_id' => $deppromo->id,
			));
		}

		$setting = Setting::first();

		$unique_id = time() * $user->id;
		$modal = 0;
		$transfer = 'false';
		

		if ($psDep == 7) {
			$merchant_id = $setting->payou_merchant_id;
			$secret_word = $setting->payou_secret;
			$order_id = $unique_id;
			$order_amount = $sum;
			$currency = 'MoneyINR_Phub';
			$user_code = $user->id;
			$user_email = $user->email;
			$sign = md5($merchant_id . ':' . $order_amount . ':' . $secret_word . ':' . $currency . ':' . $order_id);
			$link = "https://payou.pro/sci/v1/?id=" . $merchant_id . "&sistems={$currency}&summ={$order_amount}&order_id={$order_id}&user_code={$user_code}&user_email={$user_email}&hash=" . $sign . "";
		}

		if ($psDep == 8) {
			$merchant_id = $setting->kassify_merchant_id;
			$secret_word = $setting->kassify_secret;
			$order_id = $unique_id;
			//Конвертируем сумму в USD
			$order_amount = sprintf("%01.2f", str_replace(',', '.', $sum / 90));
			$currency = 'USD';
			$user_code = $user->id;
			$user_email = $user->email;
			$sign = md5($merchant_id . ':' . $order_amount . ':' . $secret_word . ':' . $order_id . ':' . $currency);

			$link = "https://kassify.com/sci_v2/?ids=" . $merchant_id . "&val={$currency}&summ={$order_amount}&us_id={$order_id}&user_code={$user_code}&s=" . $sign;
		}

		if ($psDep == 9) {
			$apiKey = $setting->pear2pay_api; // Authorization токен от Pear2Pay
			$merchantKey = $setting->pear2pay_secret;
			$order_id = $unique_id;
			$order_amount = $sum;
			$currency = 'INR';
			$user_code = $user->id;
			$user_email = $user->email;

			$link = $this->generatePear2PayLink($order_amount, $user, $order_id, $apiKey, $merchantKey, $currency, $user_code, $user_email);
		}

		if ($psDep == 10) {
			$merchant_id = $setting->payou_merchant_id;
			$secret_word = $setting->payou_secret;
			$order_id = $unique_id;
			$order_amount = $sum;
			$currency = 'ala_MoneyINR';
			$user_code = $user->id;
			$user_email = $user->email;
			$sign = md5($merchant_id . ':' . $order_amount . ':' . $secret_word . ':' . $currency . ':' . $order_id);
			$link = "https://payou.pro/sci/v1/?id=" . $merchant_id . "&sistems={$currency}&summ={$order_amount}&order_id={$order_id}&user_code={$user_code}&user_email={$user_email}&hash=" . $sign . "";
		}

		if ($psDep == 11) { // например id шлюза PayHub24
			$apiKey = $setting->payhub24_public_key;
			$privateKey = $setting->payhub24_private_key;
			$order_id = $unique_id;
			$order_amount = $sum;
			$currency = 'INR';
			$user_code = $user->id;
			$user_email = $user->email;
		
			$link = $this->generatePayHub24Link($order_amount, $user, $order_id, $apiKey, $privateKey, $currency, $user_code, $user_email);
		}

			if ($psDep == 12) {
			$apiKey = $setting->rizon_private;
			$privateKey = $setting->rizon_token;
			$order_id = $unique_id;
			$order_amount = $sum;
			$currency = 'INR';
			$user_code = $user->id;
			$user_email = $user->email;

			$link = $this->generateRizonLink($order_amount, $user, $order_id, $apiKey, $currency, $user_code, $user_email);
		}

		if ($psDep == 13) {
	
			$order_id = $unique_id;
			$order_amount = $sum;
			$currency = 'INR';
			$user_code = $user->id;
			$user_email = $user->email;

			$link = $this->generatePayokLinkH5(
				$order_amount,
				$user,
				$order_id
			);
		}
		

		Payment::create(array(
			'user_id' => $user->id,
			'login' => $user->id,
			'avatar' => $user->avatar,
			'sum' => $sum,
			'data' => date('d.m.Y H:i'),
			'transaction' => $unique_id,
			'beforepay' => $user->balance,
			'percent' => $percent,
			'img_system' => $img,
			'id_system' => $number_ps,
			'ps_system_id' => $psDep
		));

		return response(['success' => true, 'link' => $link, 'modal' => $modal, 'transfer' => $transfer, 'img' => $img]);
	}

private function generateRizonLink($orderAmount, $user, $orderId, $bearerToken, $currency, $userCode, $userEmail)
	{
		$callbackUrl = 'https://upwin-in.com/api/deposit/rizon/callback';
		$successUrl = 'https://upwin-in.com';
		$failUrl = 'https://upwin-in.com';
		$pendingUrl = 'https://upwin-in.com';
		$baseUrl = 'https://business.agbadvans.com/api/v1/payments';

		// Сумма в копейках (например: 3500.98 → 350098)
		$amountInMinorUnits = (int) round($orderAmount * 100);

		$payload = [
			"product" => (string) $userCode,
			"amount" => $amountInMinorUnits,
			"currency" => strtoupper(trim($currency)), // важно: убрать лишние пробелы
			"orderNumber" => (string) $orderId,
			"locale" => "en",
			"redirectSuccessUrl" => $successUrl,
			"redirectFailUrl" => $failUrl,
			"pendingUrl" => $pendingUrl,
			"callbackUrl" => $callbackUrl,
			"bank_account" => [
				"requisite_type" => "account",
			],
			"customer" => [
				"email" => (string) ($userEmail ?: 'no-reply@upwin.co'), // email обязательно строкой
			]
		];

		try {
			$response = Http::withToken($bearerToken)
				->withHeaders([
					'Content-Type' => 'application/json',
				])
				->post($baseUrl, $payload);

			if ($response->successful()) {
				$data = $response->json();
				return $data['selectorUrl'] ?? null;
			} else {
				\Log::error('AGBAdvans Bad Response', [
					'status' => $response->status(),
					'body' => $response->body()
				]);
				return null;
			}
		} catch (\Exception $e) {
			\Log::error('AGBAdvans Exception', [
				'message' => $e->getMessage()
			]);
			return null;
		}
	}

public function resulRizon(Request $request)
	{

		//Определяем платежные данные
		$setting = Setting::first();
		$secret_word = $setting->rizon_token;
		$unique_id = $request->orderNumber;
		$timestamp = $request->header('timestamp');
		$payload = $request->payload ?? [];
		$amount = (float) bcdiv((string) $request->amount, '100', 2);
		$intid = $request->token;
		$status = $request->status;

		$external_sign = $request->header('signature');

		/*
    // Проверка подписи
    if (!hash_equals($sign, $external_sign)) {
        Log::error('PayHub24 Error Sign Verify');
        return response(['success' => false, 'message' => "Error Sign Verify"], 400);
    }*/

		//Ищем необработанный платёж
		$payment = Payment::where('transaction', $unique_id)
			->whereIn('status', [0, 2])
			->first();

		if (!$payment) {
			Log::info('Rizon Payment not found or already processed', $request->all());
			return response([
				'success' => false,
				'message' => 'Payment not found or already processed'
			]);
		}

		//Начинаем транзакцию и сохраняем данные
		DB::beginTransaction();

		try {

			//Получаем user
			$user = User::find($payment->user_id);
			if (! $user) {
				DB::rollBack();
				return response([
					'success' => false,
					'message' => 'User not found'
				], 500);
			}

			//Сохраняем внешний ID
			$payment->update([
				'external_id' => $intid
			]);


			//Если провайдер вернул неуспешный статус
			if ($status == 'declined') {  // <= исправил тут
				$payment->update([
					'status' => 2   // 2 = неуспешный
				]);
				DB::commit();

				return response([
					'success' => false,
					'message' => 'Payment not successful'
				]);
			}
			

			if($status !== 'approved'){
					$payment->update([
					'status' => 0   // 2 = неуспешный
				]);
				DB::commit();

				return response([
					'success' => false,
					'message' => 'Payment not successful'
				]);
			}

			//Считаем сумму с добавлением процента бонуса игроку
			$amount_bonus = $amount * ($payment->percent / 100);
			$amount_with_bonus = $amount + $amount_bonus;

			//Обновляем запись платежа
			$payment->update([
				'status'      => 1,
				'afterpay'    => $user->balance + $amount_with_bonus,
				'external_id' => $intid,
			]);

			//Флаг первого депозита
			$user->bonus_up = ($user->deps === 0 && $amount_with_bonus > 5);
			//Обновляем баланс пользователя
			$user->balance += $amount_with_bonus;
			//Обновляем сумму депов пользователя
			$user->deps += $amount_with_bonus;
			//Обновляем минимальную сумму вывода
			$user->sum_to_withdraw += ($amount * 40);

			//Начисляем кешбэк
			$rates = Status::pluck('cashbb', 'id');
			$rate  = $user->status === 0
				? 1
				: ($rates->get($user->status, 1));
			$user->cashback += $amount_with_bonus * $rate / 100;

			//Пересчитываем уровень пользователя
			$new_status_id = Status::where('deposit', '<=', $user->deps)
				->orderBy('deposit', 'desc')
				->value('id');
			if ($new_status_id > $user->status) {
				$user->status = $new_status_id;
			}
			$user->save();

			if ($user->frozen) {
				try {
					$banTypeId = $this->banUser($user);
					if ($banTypeId !== null) {
						$user->update([
							'ban' => 1,
							'ban_type_id' => $banTypeId,
						]);
					}
				} catch (\Throwable $e) {
					Log::error('Ошибка при попытке забанить юзера: ' . $e->getMessage());
				}
			}


			//Начисляем реферальный бонус
			if ($refId = $user->ref_id) {
				$refUser  = \App\Models\User::find($refId);
				$refBonus = $amount_with_bonus * ($refUser->ref_coeff / 100);
				$refUser->increment('profit',      $refBonus);
				$refUser->increment('balance_ref', $refBonus);
			}

			try {
				$eventId = md5($user->id . ':' . now());

				$this->sendPostback([
					'type_payout' => 'rs',
					'external_id' => $user->external_id,
					'id' => $user->id,
					'event_id' => $eventId,
					'deposit_amount' => round($payment->sum / 97, 2),
					'deposit_currency' => 'USD',
					'revenue_amount' => round(($payment->sum * 0.83) / 93, 2),
					'revenue_currency' => 'USD',
					'email' => $user->email,
					'phone' => $user->phone,
					'country_apha2code' => 'IN',
					'offer_id' => 154
				]);
			} catch (\Throwable $e) {
				\Log::error('Ошибка при отправке депозита: ' . $e->getMessage());
			}

			DB::commit();
		} catch (\Throwable $e) {
			DB::rollBack();
			Log::error('resultPear2pay failed', [
				'order'     => $unique_id,
				'exception' => $e,
			]);

			return response([
				'success' => false,
				'message' => 'Server error'
			], 500);
		}

		// 5) Возвращаем успешный ответ
		return response([
			'success' => true,
			'message' => 'Deposit success!'
		]);
	}


public function resultPayok(Request $request)
	{

		\Log::info('PAYOK CALLBACK RECEIVED', [
        'payload' => $request->all()
    ]);
	$payload = $request->all();
		//Определяем платежные данные
		$setting = Setting::first();
		$merchant_id = $request->input('merchantOrderId');
		$unique_id = $payload['merchantOrderId'] ?? null;
		$amount = $payload['amount'] ?? null;
		$intid = $payload['platformOrderId'];
		$status = $payload['code'] ?? null;

	
		//Ищем необработанный платёж
		$payment = Payment::where('transaction', $unique_id)
			->whereIn('status', [0, 2])
			->first();

		if (!$payment) {
			return response([
				'success' => false,
				'message' => 'Payment not found or already processed'
			]);
		}

		//Начинаем транзакцию и сохраняем данные
		DB::beginTransaction();

		try {

			//Получаем user
			$user = User::find($payment->user_id);
			if (! $user) {
				DB::rollBack();
				return response([
					'success' => false,
					'message' => 'User not found'
				], 500);
			}

			//Сохраняем внешний ID
			$payment->update([
				'external_id' => $intid
			]);

			//Если провайдер вернул неуспешный статус
			if ($status !== 'SUCCESS') {
				$payment->update([
					'status' => 2   // 2 = неуспешный
				]);
				DB::commit();

				return response([
					'success' => false,
					'message' => 'Payment not successful'
				]);
			}

			//Считаем сумму с добавлением процента бонуса игроку
			$amount_bonus = $amount * ($payment->percent / 100);
			$amount_with_bonus = $amount + $amount_bonus;

			//Обновляем запись платежа
			$payment->update([
				'status'      => 1,
				'afterpay'    => $user->balance + $amount_with_bonus,
				'external_id' => $intid,
			]);

			//Флаг первого депозита
			$user->bonus_up = ($user->deps === 0 && $amount_with_bonus > 5);
			//Обновляем баланс пользователя
			$user->balance += $amount_with_bonus;
			//Обновляем сумму депов пользователя
			$user->deps += $amount_with_bonus;
			//Обновляем минимальную сумму вывода
			$user->sum_to_withdraw += ($amount * 40);

			//Начисляем кешбэк
			$rates = Status::pluck('cashbb', 'id');
			$rate  = $user->status === 0
				? 1
				: ($rates->get($user->status, 1));
			$user->cashback += $amount_with_bonus * $rate / 100;

			//Пересчитываем уровень пользователя
			$new_status_id = Status::where('deposit', '<=', $user->deps)
				->orderBy('deposit', 'desc')
				->value('id');
			if ($new_status_id > $user->status) {
				$user->status = $new_status_id;
			}
			$user->save();

			if ($user->frozen) {
				try {
					$banTypeId = $this->banUser($user);
					if ($banTypeId !== null) {
						$user->update([
							'ban' => 1,
							'ban_type_id' => $banTypeId,
						]);
					}
				} catch (\Throwable $e) {
					Log::error('Ошибка при попытке забанить юзера: ' . $e->getMessage());
				}
			}


			//Начисляем реферальный бонус
			if ($refId = $user->ref_id) {
				$refUser  = \App\Models\User::find($refId);
				$refBonus = $amount_with_bonus * ($refUser->ref_coeff / 100);
				$refUser->increment('profit',      $refBonus);
				$refUser->increment('balance_ref', $refBonus);
			}

			try {
				$eventId = md5($user->id . ':' . now());

				$this->sendPostback([
					'type_payout' => 'rs',
					'external_id' => $user->external_id,
					'id' => $user->id,
					'event_id' => $eventId,
					'deposit_amount' => round($payment->sum / 97, 2),
					'deposit_currency' => 'USD',
					'revenue_amount' => round(($payment->sum * 0.86) / 96, 2),
					'revenue_currency' => 'USD',
					'email' => $user->email,
					'phone' => $user->phone,
					'country_apha2code' => 'IN',
					'offer_id' => 154
				]);
			} catch (\Throwable $e) {
				\Log::error('Ошибка при отправке депозита: ' . $e->getMessage());
			}

			DB::commit();
		} catch (\Throwable $e) {
			DB::rollBack();
			Log::error('resultPayyou failed', [
				'order'     => $unique_id,
				'exception' => $e,
			]);

			return response([
				'success' => false,
				'message' => 'Server error'
			], 500);
		}

		// 5) Возвращаем успешный ответ
		return response([
			'success' => true,
			'message' => 'Deposit success!'
		]);
	}



	public function generatePayokLinkH5($orderAmount, $user, $orderId): ?string
{
    $baseUrl = 'https://api.payok.com';
    $apiPath = '/api-pay/payment/V3.4/order/create-h5';

    $payload = [
        'merchantId' => '420316',
        'requestTime' => gmdate("Y-m-d\TH:i:s.v\Z"),
        'merchantOrderId' => $orderId,
        'amount' => (float) $orderAmount,
        'notificationUrl' => 'https://upwin-in.com/api/deposit/payok/callback',
        'paymentMethodCode' => 'UPI',
        'countryCode' => 'IN',
        'currency' => 'INR',
        'language' => 'EN',
        'returnUrl' => 'https://upwin-in.com/',
        'customer' => [
            'name' => (string) $user->id,
            'email' => $user->email,
            'phone' => $user->phone,
            'countryName' => 'India',
            'ip' => request()->ip(),
            'deviceId' => md5($user->email . request()->ip()),
        ],
        'goodsInfo' => [
            'name'  => 'Deposit',
            'id'    => $orderId,
            'price' => number_format($orderAmount, 2, '.', ''),
        ]
    ];

    $json = json_encode($payload, JSON_UNESCAPED_SLASHES);
    $dataToSign = $json . '&' . $apiPath;

    // Читаем приватный ключ из файла
    $privateKeyPath = '/var/www/product/payok_keys/private.key.pem';
    if (!file_exists($privateKeyPath)) {
        \Log::error('PAYOK: Private key file not found');
        return null;
    }

    $privateKeyContent = file_get_contents($privateKeyPath);
    $privateKey = openssl_pkey_get_private($privateKeyContent);

    if (!$privateKey) {
        \Log::error('PAYOK: Invalid private key');
        return null;
    }

    if (!openssl_sign($dataToSign, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
        \Log::error('PAYOK: Failed to sign request');
        return null;
    }

    $signatureBase64 = base64_encode($signature);

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'sign' => $signatureBase64,
    ])->withBody($json, 'application/json')
      ->post($baseUrl . $apiPath);

    \Log::channel('daily')->info('PAYOK FULL LOG', [
        'payload'       => $payload,
        'json_encoded'  => $json,
        'data_to_sign'  => $dataToSign,
        'signature'     => $signatureBase64,
        'response_raw'  => $response->body(),
        'response_json' => $response->json(),
        'http_status'   => $response->status(),
    ]);

    $json = $response->json();

    if (isset($json['code']) && $json['code'] === 'SUCCESS' && isset($json['paymentInfo']['content'])) {
        return $json['paymentInfo']['content'];
    }

    \Log::error('PAYOK: Invalid response', ['json' => $json]);
    return null;
}

	private function generatePear2PayLink($orderAmount, $user, $orderId, $apiKey, $merchantKey, $currency, $userCode, $userEmail)
	{
		// Конфигурация
		$callbackUrl = 'https://upwin-in.com/api/deposit/pear2pay/callback';
		$successUrl = 'https://upwin-in.com';
		$failUrl = 'https://upwin-in.com';
		$baseUrl = 'https://api.pear2pay.com'; // для дев-окружения

		$payload = [
			'key'          => $merchantKey, // можно убрать если не требуется
			'email'        => $userEmail,
			'currency'     => $currency,
			'order_id'     => $orderId,
			'amount'       => sprintf("%01.2f", $orderAmount),
			'callback_url' => $callbackUrl,
			'success_url'  => $successUrl,
			'fail_url'     => $failUrl,
			'client_id'    => $userCode,
			//'sender_name' => 'FirstName LastName',
			//'last_n_digits' => 0000,
		];

		try {
			$response = Http::withHeaders([
				'Authorization' => $apiKey,
				'Content-Type'  => 'application/json',
			])->post("{$baseUrl}/api/payments/merchant/generate_invoice/", $payload);

			if ($response->successful()) {
				$data = $response->json();

				return $data['paymentURL'] ?? null;
			} else {
				\Log::error('Pear2Pay Bad Response', [
					'status' => $response->status(),
					'body' => $response->body()
				]);

				return null;
			}
		} catch (\Exception $e) {
			\Log::error('Pear2Pay Exception', [
				'message' => $e->getMessage()
			]);

			return null;
		}
	}


	private function generatePayHub24Link($orderAmount, $user, $orderId, $apiKey, $privateKey, $currency, $userCode, $userEmail)
{
    // Конфигурация
    $callbackUrl = 'https://upwin-in.com/api/deposit/payhub24/callback'; // URL для получения статуса платежа
    $successUrl = 'https://upwin-in.com';
    $failUrl = 'https://upwin-in.com';
    $baseUrl = 'https://api.payhub24.com'; // Продакшн URL
    $timestamp = time(); // Текущий UNIX timestamp

    // Тело запроса
    $payload = [
        "sub_token" => "UPI",
        "pay_data" => [
            "amount" => (float) sprintf("%01.2f", $orderAmount),
            "currency" => $currency,
            "description" => "Deposit for order #" . $orderId,
        ],
        "client_data" => [
            "client_id" => (string) $userCode,
            "order_id" => (string) $orderId,
            "ip" => request()->ip() ?? '127.0.0.1',
            "phone" => $user->phone ?? '0000000000', // Обязательно проверь, чтобы поле phone у пользователя было заполнено
            "email" => $userEmail,
            "country" => 'IN', // Для Индии
        ],
        "callback_url" => $callbackUrl,
        "extra_data" => [
            "redirect_success_url" => $successUrl,
            "redirect_error_url" => $failUrl,
        ]
    ];

    // Генерация подписи
    $message = $timestamp . json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $signature = hash_hmac('sha512', $message, $privateKey);

    try {
        $response = Http::withHeaders([
            'X-API-Key' => $apiKey,
            'X-Signature' => $signature,
            'X-Timestamp' => $timestamp,
            'Content-Type' => 'application/json',
        ])->post("{$baseUrl}/create/payin/HPP/", $payload);

        if ($response->successful()) {
            $data = $response->json();

            return $data['redirect_url'] ?? null; // Это ссылка, куда надо редиректить юзера
        } else {
            \Log::error('PayHub24 Bad Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return null;
        }
    } catch (\Exception $e) {
        \Log::error('PayHub24 Exception', [
            'message' => $e->getMessage()
        ]);

        return null;
    }
}



	public function resultPayyou(Request $request)
	{


		//Определяем платежные данные
		$setting = Setting::first();
		$merchant_id = $setting->payou_merchant_id;
		$secret_word = $setting->payou_secret;
		$unique_id = $request->MERCHANT_ORDER_ID;
		$amount = $request->AMOUNT;
		$intid = $request->intid;
		$status = $request->status;
		$external_sign = $request->SIGN;

		//Формируем ключ подписи
		$sign = md5(
			"{$merchant_id}:{$amount}:{$secret_word}:{$status}:{$intid}:{$unique_id}"
		);

		//Проверяем ключ подписи
		if ($sign != $external_sign) {
			return response(['success' => false, 'message' => "Error Sign Verify"]);
		}

		//Ищем необработанный платёж
		$payment = Payment::where('transaction', $unique_id)
			->whereIn('status', [0, 2])
			->first();

		if (!$payment) {
			return response([
				'success' => false,
				'message' => 'Payment not found or already processed'
			]);
		}

		//Начинаем транзакцию и сохраняем данные
		DB::beginTransaction();

		try {

			//Получаем user
			$user = User::find($payment->user_id);
			if (! $user) {
				DB::rollBack();
				return response([
					'success' => false,
					'message' => 'User not found'
				], 500);
			}

			//Сохраняем внешний ID
			$payment->update([
				'external_id' => $intid
			]);

			//Если провайдер вернул неуспешный статус
			if ($status !== 'success') {
				$payment->update([
					'status' => 2   // 2 = неуспешный
				]);
				DB::commit();

				return response([
					'success' => false,
					'message' => 'Payment not successful'
				]);
			}

			//Считаем сумму с добавлением процента бонуса игроку
			$amount_bonus = $amount * ($payment->percent / 100);
			$amount_with_bonus = $amount + $amount_bonus;

			//Обновляем запись платежа
			$payment->update([
				'status'      => 1,
				'afterpay'    => $user->balance + $amount_with_bonus,
				'external_id' => $intid,
			]);

			//Флаг первого депозита
			$user->bonus_up = ($user->deps === 0 && $amount_with_bonus > 5);
			//Обновляем баланс пользователя
			$user->balance += $amount_with_bonus;
			//Обновляем сумму депов пользователя
			$user->deps += $amount_with_bonus;
			//Обновляем минимальную сумму вывода
			$user->sum_to_withdraw += ($amount * 40);

			//Начисляем кешбэк
			$rates = Status::pluck('cashbb', 'id');
			$rate  = $user->status === 0
				? 1
				: ($rates->get($user->status, 1));
			$user->cashback += $amount_with_bonus * $rate / 100;

			//Пересчитываем уровень пользователя
			$new_status_id = Status::where('deposit', '<=', $user->deps)
				->orderBy('deposit', 'desc')
				->value('id');
			if ($new_status_id > $user->status) {
				$user->status = $new_status_id;
			}
			$user->save();

			if ($user->frozen) {
				try {
					$banTypeId = $this->banUser($user);
					if ($banTypeId !== null) {
						$user->update([
							'ban' => 1,
							'ban_type_id' => $banTypeId,
						]);
					}
				} catch (\Throwable $e) {
					Log::error('Ошибка при попытке забанить юзера: ' . $e->getMessage());
				}
			}


			//Начисляем реферальный бонус
			if ($refId = $user->ref_id) {
				$refUser  = \App\Models\User::find($refId);
				$refBonus = $amount_with_bonus * ($refUser->ref_coeff / 100);
				$refUser->increment('profit',      $refBonus);
				$refUser->increment('balance_ref', $refBonus);
			}

			try {
				$eventId = md5($user->id . ':' . now());

				$this->sendPostback([
					'type_payout' => 'rs',
					'external_id' => $user->external_id,
					'id' => $user->id,
					'event_id' => $eventId,
					'deposit_amount' => $payment->sum,
					'deposit_currency' => 'INR',
					'revenue_amount' => $payment->sum / 2,
					'revenue_currency' => 'INR',
					'email' => $user->email,
					'phone' => $user->phone,
					'country_apha2code' => 'IN',
					'offer_id' => 154
				]);
			} catch (\Throwable $e) {
				\Log::error('Ошибка при отправке депозита: ' . $e->getMessage());
			}

			DB::commit();
		} catch (\Throwable $e) {
			DB::rollBack();
			Log::error('resultPayyou failed', [
				'order'     => $unique_id,
				'exception' => $e,
			]);

			return response([
				'success' => false,
				'message' => 'Server error'
			], 500);
		}

		// 5) Возвращаем успешный ответ
		return response([
			'success' => true,
			'message' => 'Deposit success!'
		]);
	}



	public function resultPear2pay(Request $request)
	{

		Log::info('Pear2Pay Callback Received', [
			'body' => $request->all(),
			'headers' => $request->headers->all(),
		]);
		

		//Определяем платежные данные
		$setting = Setting::first();
		$secret_word = $setting->pear2pay_secret;
		$unique_id = $request->order_id;
		$amount = $request->amount;
		$intid = $request->uuid;
		$status = $request->status;

	// Проверяем подпись
	$request_raw = file_get_contents('php://input');
	Log::info('Pear2Pay Raw Input for Signature', [
		'raw_input' => $request_raw,
	]);
	$external_sign = $request->header('pear2pay-signature');
	$sign = hash_hmac('sha256', $request_raw, $secret_word);

    // Проверка подписи
    /*if(!hash_equals($sign, $external_sign)) {
         Log::error('Pear2Pay Error Sign Verify', [
        'calculated' => $sign,
        'received' => $external_sign,
    ]);
        return response(['success' => false, 'message' => "Error Sign Verify"], 400);
    }*/

		//Ищем необработанный платёж
		$payment = Payment::where('transaction', $unique_id)
		->whereIn('status', [0, 2])
			->first();

		if (!$payment) {
			Log::info('Pear2Pay Payment not found or already processed', $request->all());
			return response([
				'success' => false,
				'message' => 'Payment not found or already processed'
			]);
		}

		//Начинаем транзакцию и сохраняем данные
		DB::beginTransaction();

		try {

			//Получаем user
			$user = User::find($payment->user_id);
			if (! $user) {
				DB::rollBack();
				return response([
					'success' => false,
					'message' => 'User not found'
				], 500);
			}

			//Сохраняем внешний ID
			$payment->update([
				'external_id' => $intid
			]);

			//Если провайдер вернул неуспешный статус
			if ($status !== 'CONFIRMED') {
				$payment->update([
					'status' => 2   // 2 = неуспешный
				]);
				DB::commit();

				return response([
					'success' => false,
					'message' => 'Payment not successful'
				]);
			}

			//Считаем сумму с добавлением процента бонуса игроку
			$amount_bonus = $amount * ($payment->percent / 100);
			$amount_with_bonus = $amount + $amount_bonus;

			//Обновляем запись платежа
			$payment->update([
				'status'      => 1,
				'afterpay'    => $user->balance + $amount_with_bonus,
				'external_id' => $intid,
			]);

			//Флаг первого депозита
			$user->bonus_up = ($user->deps === 0 && $amount_with_bonus > 5);
			//Обновляем баланс пользователя
			$user->balance += $amount_with_bonus;
			//Обновляем сумму депов пользователя
			$user->deps += $amount_with_bonus;
			//Обновляем минимальную сумму вывода
			$user->sum_to_withdraw += ($amount * 40);

			//Начисляем кешбэк
			$rates = Status::pluck('cashbb', 'id');
			$rate  = $user->status === 0
				? 1
				: ($rates->get($user->status, 1));
			$user->cashback += $amount_with_bonus * $rate / 100;

			//Пересчитываем уровень пользователя
			$new_status_id = Status::where('deposit', '<=', $user->deps)
				->orderBy('deposit', 'desc')
				->value('id');
			if ($new_status_id > $user->status) {
				$user->status = $new_status_id;
			}
			$user->save();

			if ($user->frozen) {
				try {
					$banTypeId = $this->banUser($user);
					if ($banTypeId !== null) {
						$user->update([
							'ban' => 1,
							'ban_type_id' => $banTypeId,
						]);
					}
				} catch (\Throwable $e) {
					Log::error('Ошибка при попытке забанить юзера: ' . $e->getMessage());
				}
			}


			//Начисляем реферальный бонус
			if ($refId = $user->ref_id) {
				$refUser  = \App\Models\User::find($refId);
				$refBonus = $amount_with_bonus * ($refUser->ref_coeff / 100);
				$refUser->increment('profit',      $refBonus);
				$refUser->increment('balance_ref', $refBonus);
			}

			try {
				$eventId = md5($user->id . ':' . now());

				$this->sendPostback([
					'type_payout' => 'rs',
					'external_id' => $user->external_id,
					'id' => $user->id,
					'event_id' => $eventId,
					'deposit_amount' => $payment->sum,
					'deposit_currency' => 'INR',
					'revenue_amount' => $payment->sum / 2,
					'revenue_currency' => 'INR',
					'email' => $user->email,
					'phone' => $user->phone,
					'country_apha2code' => 'IN',
					'offer_id' => 154
				]);
			} catch (\Throwable $e) {
				\Log::error('Ошибка при отправке депозита: ' . $e->getMessage());
			}

			DB::commit();
		} catch (\Throwable $e) {
			DB::rollBack();
			Log::error('resultPear2pay failed', [
				'order'     => $unique_id,
				'exception' => $e,
			]);

			return response([
				'success' => false,
				'message' => 'Server error'
			], 500);
		}

		// 5) Возвращаем успешный ответ
		return response([
			'success' => true,
			'message' => 'Deposit success!'
		]);
	}

	public function resultPayhub24(Request $request)
	{

		//Определяем платежные данные
		$setting = Setting::first();
		$secret_word = $setting->payhub24_private_key;
		$unique_id = $request->client_order_id;
		$timestamp = $request->header('timestamp');
		$payload = $request->payload ?? [];
		$amount = $payload['amount'];
		$intid = $request->transaction_id;
		$status = $request->status;

		$external_sign = $request->header('signature');

	//Генерация подписи
    $body = $request->all();
    $bodyJson = json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $stringToSign = $timestamp . $bodyJson;
    $sign = hash_hmac('sha512', $stringToSign, $secret_word);

    Log::info('PayHub24 Signature Debug', [
        'calculated' => $sign,
        'received' => $external_sign,
        'string_to_sign' => $stringToSign,
    ]);
	
	/*
    // Проверка подписи
    if (!hash_equals($sign, $external_sign)) {
        Log::error('PayHub24 Error Sign Verify');
        return response(['success' => false, 'message' => "Error Sign Verify"], 400);
    }*/

		//Ищем необработанный платёж
		$payment = Payment::where('transaction', $unique_id)
			->whereIn('status', [0, 2])
			->first();

		if (!$payment) {
			Log::info('Pear2Pay Payment not found or already processed', $request->all());
			return response([
				'success' => false,
				'message' => 'Payment not found or already processed'
			]);
		}

		//Начинаем транзакцию и сохраняем данные
		DB::beginTransaction();

		try {

			//Получаем user
			$user = User::find($payment->user_id);
			if (! $user) {
				DB::rollBack();
				return response([
					'success' => false,
					'message' => 'User not found'
				], 500);
			}

			//Сохраняем внешний ID
			$payment->update([
				'external_id' => $intid
			]);

			//Если провайдер вернул неуспешный статус
			if ($status !== 'success') {  // <= исправил тут
				$payment->update([
					'status' => 2   // 2 = неуспешный
				]);
				DB::commit();
			
				return response([
					'success' => false,
					'message' => 'Payment not successful'
				]);
			}

			//Считаем сумму с добавлением процента бонуса игроку
			$amount_bonus = $amount * ($payment->percent / 100);
			$amount_with_bonus = $amount + $amount_bonus;

			//Обновляем запись платежа
			$payment->update([
				'status'      => 1,
				'afterpay'    => $user->balance + $amount_with_bonus,
				'external_id' => $intid,
			]);

			//Флаг первого депозита
			$user->bonus_up = ($user->deps === 0 && $amount_with_bonus > 5);
			//Обновляем баланс пользователя
			$user->balance += $amount_with_bonus;
			//Обновляем сумму депов пользователя
			$user->deps += $amount_with_bonus;
			//Обновляем минимальную сумму вывода
			$user->sum_to_withdraw += ($amount * 40);

			//Начисляем кешбэк
			$rates = Status::pluck('cashbb', 'id');
			$rate  = $user->status === 0
				? 1
				: ($rates->get($user->status, 1));
			$user->cashback += $amount_with_bonus * $rate / 100;

			//Пересчитываем уровень пользователя
			$new_status_id = Status::where('deposit', '<=', $user->deps)
				->orderBy('deposit', 'desc')
				->value('id');
			if ($new_status_id > $user->status) {
				$user->status = $new_status_id;
			}
			$user->save();

			if ($user->frozen) {
				try {
					$banTypeId = $this->banUser($user);
					if ($banTypeId !== null) {
						$user->update([
							'ban' => 1,
							'ban_type_id' => $banTypeId,
						]);
					}
				} catch (\Throwable $e) {
					Log::error('Ошибка при попытке забанить юзера: ' . $e->getMessage());
				}
			}


			//Начисляем реферальный бонус
			if ($refId = $user->ref_id) {
				$refUser  = \App\Models\User::find($refId);
				$refBonus = $amount_with_bonus * ($refUser->ref_coeff / 100);
				$refUser->increment('profit',      $refBonus);
				$refUser->increment('balance_ref', $refBonus);
			}

			try {
				$eventId = md5($user->id . ':' . now());

				$this->sendPostback([
					'type_payout' => 'rs',
					'external_id' => $user->external_id,
					'id' => $user->id,
					'event_id' => $eventId,
					'deposit_amount' => round($payment->sum / 99, 2),
					'deposit_currency' => 'USD',
					'revenue_amount' => round(($payment->sum * 0.89) / 98, 2),
					'revenue_currency' => 'USD',
					'email' => $user->email,
					'phone' => $user->phone,
					'country_apha2code' => 'IN',
					'offer_id' => 154
				]);
			} catch (\Throwable $e) {
				\Log::error('Ошибка при отправке депозита: ' . $e->getMessage());
			}

			DB::commit();
		} catch (\Throwable $e) {
			DB::rollBack();
			Log::error('resultPear2pay failed', [
				'order'     => $unique_id,
				'exception' => $e,
			]);

			return response([
				'success' => false,
				'message' => 'Server error'
			], 500);
		}

		// 5) Возвращаем успешный ответ
		return response([
			'success' => true,
			'message' => 'Deposit success!'
		]);
	}



	public function resultKassify(Request $request)
	{

		//Определяем платежные данные
		$setting = Setting::first();
		$merchant_id = $setting->kassify_merchant_id;
		$secret_word = $setting->kassify_secret;
		$unique_id = $request->order_id;
		$amount = $request->sum3;
		$intid = $request->idoerations_shop;
		$status = $request->status_shop;
		$external_sign = $request->hash;

		//Формируем ключ подписи
		$sign = md5(
			"{$merchant_id}:{$amount}:{$secret_word}:{$status}:{$intid}:{$unique_id}"
		);

		

		//Проверяем ключ подписи
		if ($sign != $external_sign) {
			return response(['success' => false, 'message' => "Error Sign Verify"]);
		}
		//Конвертируем сумму в INR
		$amount = floatval(str_replace(',', '.', $amount)) * 90;

		//Ищем необработанный платёж
		$payment = Payment::where('transaction', $unique_id)
			->whereIn('status', [0, 2])
			->first();

		if (!$payment) {
			return response([
				'success' => false,
				'message' => 'Payment not found or already processed'
			]);
		}

		//Начинаем транзакцию и сохраняем данные
		DB::beginTransaction();

		try {

			//Получаем user
			$user = User::find($payment->user_id);
			if (! $user) {
				DB::rollBack();
				return response([
					'success' => false,
					'message' => 'User not found'
				], 500);
			}

			//Сохраняем внешний ID
			$payment->update([
				'external_id' => $intid
			]);

			//Если провайдер вернул неуспешный статус
			if ($status !== 'success') {
				$payment->update([
					'status' => 2   // 2 = неуспешный
				]);
				DB::commit();

				return response([
					'success' => false,
					'message' => 'Payment not successful'
				]);
			}

			//Считаем сумму с добавлением процента бонуса игроку
			$amount_bonus = $amount * ($payment->percent / 100);
			$amount_with_bonus = $amount + $amount_bonus;

			//Обновляем запись платежа
			$payment->update([
				'status'      => 1,
				'afterpay'    => $user->balance + $amount_with_bonus,
				'external_id' => $intid,
			]);

			//Флаг первого депозита
			$user->bonus_up = ($user->deps === 0 && $amount_with_bonus > 5);
			//Обновляем баланс пользователя
			$user->balance += $amount_with_bonus;
			//Обновляем сумму депов пользователя
			$user->deps += $amount_with_bonus;
			//Обновляем минимальную сумму вывода
			$user->sum_to_withdraw += ($amount * 40);

			//Начисляем кешбэк
			$rates = Status::pluck('cashbb', 'id');
			$rate  = $user->status === 0
				? 1
				: ($rates->get($user->status, 1));
			$user->cashback += $amount_with_bonus * $rate / 100;

			//Пересчитываем уровень пользователя
			$new_status_id = Status::where('deposit', '<=', $user->deps)
				->orderBy('deposit', 'desc')
				->value('id');
			if ($new_status_id > $user->status) {
				$user->status = $new_status_id;
			}
			$user->save();

			if ($user->frozen) {
				try {
					$banTypeId = $this->banUser($user);
					if ($banTypeId !== null) {
						$user->update([
							'ban' => 1,
							'ban_type_id' => $banTypeId,
						]);
					}
				} catch (\Throwable $e) {
					Log::error('Ошибка при попытке забанить юзера: ' . $e->getMessage());
				}
			}


			//Начисляем реферальный бонус
			if ($refId = $user->ref_id) {
				$refUser  = \App\Models\User::find($refId);
				$refBonus = $amount_with_bonus * ($refUser->ref_coeff / 100);
				$refUser->increment('profit',      $refBonus);
				$refUser->increment('balance_ref', $refBonus);
			}

			try {
				$eventId = md5($user->id . ':' . now());

				$this->sendPostback([
					'type_payout' => 'rs',
					'external_id' => $user->external_id,
					'id' => $user->id,
					'event_id' => $eventId,
					'deposit_amount' => round($payment->sum / 95, 2),
					'deposit_currency' => 'USD',
					'revenue_amount' => round(($payment->sum * 0.94) / 95, 2),
					'revenue_currency' => 'USD',
					'email' => $user->email,
					'phone' => $user->phone,
					'country_apha2code' => 'IN',
					'offer_id' => 154
				]);
			} catch (\Throwable $e) {
				\Log::error('Ошибка при отправке депозита: ' . $e->getMessage());
			}


			DB::commit();
		} catch (\Throwable $e) {
			DB::rollBack();
			Log::error('resultPayyou failed', [
				'order'     => $unique_id,
				'exception' => $e,
			]);

			return response([
				'success' => false,
				'message' => 'Server error'
			], 500);
		}

		// 5) Возвращаем успешный ответ
		return response([
			'success' => true,
			'message' => 'Deposit success!'
		]);
	}





	public function sendPostback(array $data)
	{
		$baseUrl = 'https://api.traffhunt.com/api/postback/deposit';

		// Список поддерживаемых параметров
		$allowedParams = [
			'type_payout' => 'type_payout',
			'lead_id' => 'external_id',
			'platform_id' => 'id',
			'event_id' => 'event_id',
			'deposit_amount' => 'deposit_amount',
			'deposit_currency' => 'deposit_currency',
			'revenue_amount' => 'revenue_amount',
			'revenue_currency' => 'revenue_currency',
			'offer_id' => 'offer_id',
			'advertiser_offer_id' => 'advertiser_offer_id',
			//'email' => 'email',
			//'phone' => 'phone',
			'country_apha2code' => 'country_alpha2code',
			'country' => 'country',
			'event_date' => 'event_date',
		];

		$queryParams = [];

		foreach ($allowedParams as $paramName => $dataKey) {
			if (!empty($data[$dataKey])) {
				$queryParams[$paramName] = $data[$dataKey];
			}
		}

		try {
			$response = Http::timeout(10)->get($baseUrl, $queryParams);

			if (!$response->successful()) {
				Log::error('Ошибка при отправке постбека депозита: Неверный ответ', [
					'status' => $response->status(),
					'body' => $response->body(),
				]);
			}
		} catch (\Throwable $e) {
			Log::error('Ошибка при отправке постбека депозита: ' . $e->getMessage());
		}

		return;
	}

	private function banUser(User $user)
	{
		// Уже забанен — пропускаем
		if ($user->ban === 1) {
			return;
		}
		$ban_type_id = null;
		$ip = $user->ip;
		$country = $this->getCountryByIp($ip);
		$externalId = $user->external_id;
		
		if($country == 'IN'){
			$ban_type_id = 1;
			return $ban_type_id;
		}

		if($country != 'IN' && $externalId !== null){
			$hasVpnBan = User::where('external_id', $externalId)
            ->where('ban', 1)
            ->where('ban_type_id', 2)
            ->exists();

			if (!$hasVpnBan) {
				$ban_type_id = 2;
				return $ban_type_id;
			}
		}

		if ($country != 'IN' && $externalId !== null) {
			$hasOtherBan = User::where('external_id', $externalId)
				->where('ban', 1)
				->where('ban_type_id', '!=', 5)
				->exists();
		
			if ($hasOtherBan) {
				$ban_type_id = 5;
				return $ban_type_id;
			}
		}

		$ban_type_id = 6;
		return $ban_type_id;
	}

	private function getCountryByIp($ip)
	{
		try {
			$url = "http://ipwho.is/{$ip}";
    
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 3);
			
			$response = curl_exec($ch);
			$curlError = curl_error($ch);
			
			curl_close($ch);
			
			if ($response === false) {
				error_log("IP lookup failed: {$ip}, cURL error: {$curlError}");
				return 'UNKNOWN';
			}
			
			$data = json_decode($response, true);
			
			if (isset($data['success']) && $data['success'] === true && isset($data['country_code'])) {
				return $data['country_code'];
			}
			
			return 'UNKNOWN';
		} catch (\Throwable $e) {
			Log::warning("IP lookup failed: {$ip}");
		}
		return 'UNKNOWN';
	}

	private function mirrorPostRequest(Request $request, string $targetUrl)
{
	try {
		Http::timeout(5)->post($targetUrl, $request->all());
	} catch (\Throwable $e) {
		Log::warning('Mirror request failed: ' . $e->getMessage());
	}
}
}

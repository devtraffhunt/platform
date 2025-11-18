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
use Illuminate\Support\Str;

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

		$unique_id = $user->id . '-' . Str::uuid()->toString();
		$modal = 0;
		$transfer = 'false';
		$details = null;
		$external_id = null;

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
			$order_amount = sprintf("%01.2f", str_replace(',', '.', $sum / 12019));
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


		if ($psDep == 1) {
	
			$order_id = $unique_id;
			$order_amount = $sum;
			$currency = 'UZS';
			$user_code = $user->id;
			$user_email = $user->email;
			$details = '5614681627813276';

			$link = 'id';
		}

		if ($psDep == 2) { // например id шлюза PayHub24
			$apiKey = $setting->payhub24_public_key;
			$privateKey = $setting->payhub24_private_key;
			$order_id = $unique_id;
			$order_amount = $sum;
			$currency = 'UZS';
			$user_code = $user->id;
			$user_email = $user->email;
		
			$result = $this->generatePayHub24Link($order_amount, $user, $order_id, $apiKey, $privateKey, $currency, $user_code, $user_email);
			$external_id = $result['transaction_id'];
			$details = json_encode([
    'bank' => $result['bank'] ?? null,
    'holder' => $result['holder'] ?? null,
    'card' => $result['requisite'] ?? null,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

			$link = $result['link'];
		}
		

		$payment = Payment::create(array(
			'user_id' => $user->id,
			'external_id' => $external_id,
			'login' => $user->id,
			'avatar' => $user->avatar,
			'sum' => $sum,
			'data' => date('d.m.Y H:i'),
			'transaction' => $unique_id,
			'beforepay' => $user->balance,
			'percent' => $percent,
			'img_system' => $img,
			'id_system' => $number_ps,
			'details' => $details,
			'ps_system_id' => $psDep
		));

		if($link == 'id'){

			return response([
    'success' => true,
    'link' => '/pay/' . $payment->transaction,
    'modal' => $modal,
    'transfer' => $transfer,
    'img' => $img
]);

		}else{
			return response(['success' => true, 'link' => $link, 'modal' => $modal, 'transfer' => $transfer, 'img' => $img]);
		}
		
	}



	


private function generatePayHub24Link($orderAmount, $user, $orderId, $apiKey, $privateKey, $currency, $userCode, $userEmail)
{
    $callbackUrl = 'https://dev.upwin.co/api/deposit/payhub24/callback';
    $successUrl = 'https://dev.upwin.co';
    $failUrl = 'https://dev.upwin.co';
    $baseUrl = 'https://api.payhub24.com';
    $timestamp = time();

    $payload = [
        "sub_token" => "P2P_CARD",
        "pay_data" => [
            "amount" => (float) sprintf("%01.2f", $orderAmount),
            "currency" => $currency,
            "description" => "Deposit for order #" . $orderId,
        ],
        "client_data" => [
            "client_id" => (string) $userCode,
            "order_id" => (string) $orderId,
            "ip" => request()->ip() ?? '127.0.0.1',
            "phone" => $user->phone ?? '0000000000',
            "email" => $userEmail,
            "country" => 'UZ',
        ],
        "callback_url" => $callbackUrl,
        "extra_data" => [
            "redirect_success_url" => $successUrl,
            "redirect_error_url" => $failUrl,
        ]
    ];

    $message = $timestamp . json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $signature = hash_hmac('sha512', $message, $privateKey);

    try {
        $response = Http::withHeaders([
            'X-API-Key' => $apiKey,
            'X-Signature' => $signature,
            'X-Timestamp' => $timestamp,
            'Content-Type' => 'application/json',
        ])->post("{$baseUrl}/create/payin/H2H/", $payload);

        // Логируем всё, без условий
        \Log::info('PayHub24 Response', [
            'url' => "{$baseUrl}/create/payin/H2H/",
            'status' => $response->status(),
            'headers' => $response->headers(),
            'body' => $response->body(),
            'json' => $response->json(),
            'payload' => $payload,
            'signature' => $signature,
            'timestamp' => $timestamp,
        ]);

        // Если запрос успешен и в ответе есть payment_data — возвращаем его
        if ($response->successful()) {
            $data = $response->json();

            if (!empty($data['payment_data'])) {
                return [
                    'transaction_id' => $data['transaction_id'] ?? null,
                    'client_order_id' => $data['client_order_id'] ?? null,
                    'status' => $data['status'] ?? null,
                    'currency' => $data['payload']['currency'] ?? null,
                    'amount' => $data['payload']['amount'] ?? null,
                    'commission' => $data['payload']['commission'] ?? null,
                    'final_amount' => $data['payload']['final_amount'] ?? null,
                    'requisite' => $data['payment_data']['requisite'] ?? null,
                    'holder' => $data['payment_data']['holder'] ?? null,
                    'bank' => $data['payment_data']['bank'] ?? null,
					'link' => 'id'
                ];
            }
        }

        return null;

    } catch (\Throwable $e) {
        \Log::error('PayHub24 Exception', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'payload' => $payload,
            'timestamp' => $timestamp,
            'signature' => $signature
        ]);
        return null;
    }
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
					'deposit_amount' => round($payment->sum / 12000, 2),
					'deposit_currency' => 'USD',
					'revenue_amount' => round(($payment->sum * 0.89) / 12000, 2),
					'revenue_currency' => 'USD',
					'email' => $user->email,
					'phone' => $user->phone,
					'country_apha2code' => 'UZ',
					'offer_id' => 161
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
					'deposit_amount' => round($payment->sum / 12000, 2),
					'deposit_currency' => 'USD',
					'revenue_amount' => round(($payment->sum * 0.94) / 12000, 2),
					'revenue_currency' => 'USD',
					'email' => $user->email,
					'phone' => $user->phone,
					'country_apha2code' => 'UZ',
					'offer_id' => 161
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
		
		if($country == 'UZ'){
			$ban_type_id = 1;
			return $ban_type_id;
		}

		if($country != 'UZ' && $externalId !== null){
			$hasVpnBan = User::where('external_id', $externalId)
            ->where('ban', 1)
            ->where('ban_type_id', 2)
            ->exists();

			if (!$hasVpnBan) {
				$ban_type_id = 2;
				return $ban_type_id;
			}
		}

		if ($country != 'UZ' && $externalId !== null) {
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

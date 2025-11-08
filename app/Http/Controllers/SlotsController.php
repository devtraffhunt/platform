<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slots;
use App\Providers;
use App\User;
use Carbon\Carbon;
use App\Message;
use Auth;
use App\Payment;
use App\Tourniers;
use App\Setting;
use App\TournierTable;
use App\LogsSlots;
use App\HistoryBalance;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class SlotsController extends Controller
{

    public function gamePage($id)
{
    $user = auth()->user();
    if (!$user) return redirect('/?modal=regquick');

    if ($user->frozen != 1 && $user->admin == 0) {
    $settings = \App\Setting::first();

    if ($user->balance > $settings->min_withdrawal_amount) {
        $frozenLimit = $settings->frozen_amount;

        if ($user->balance >= $frozenLimit && $frozenLimit != 0) {
            $user->frozen = 1;
            $user->save();
        }
    }
}


    $slot = Slots::where('game_id', $id)->firstOrFail();

    $url = null;

    if($slot->is_our == 1){
        if ($slot->game_id == 'aviator') return redirect('/crash');
        if($slot->provider == 'inout'){
            $url = $this->getInOut($id);
        }else{
            $url = null;
        }
    }else{
        $url = $this->getGameURI('real', $id);
    }

    return view('game', [
    'url' => $url,
    'title' => $slot->title,
    'page' => '', // или любое другое значение, главное — чтоб не было undefined
]);
}

private function getInOut(string $game_key): ?string
{
    $operatorId = env('INOUT_OPERATOR_ID');
    $domain = env('INOUT_DOMAIN'); 
    $secret = env('INOUT_KEY');
    $user = auth()->user();

    $token = md5("{" . $user->id . ":" . $operatorId . ":" . $secret . "}");

    $payload = [
        'operator'   => (string) $operatorId,
        'auth_token' => $token,
        'currency'   => 'UZS',
        'lang' => 'uz',
        'game_mode'  => (string)$game_key,
        'user_id'    => (string) $user->id,
    ];

    $response = Http::timeout(10)->post('https://'.$domain.'/api/auth', $payload);

    if ($response->successful() && isset($response['iframe_url'])) {
        return $response['iframe_url'];
    }

    return null;
}


    public function getGames(Request $request)
    {
        $providerId = $request->input('provider_id');
        $search     = $request->input('search');
        $perPage    = 60;

        $query = Slots::query()
            ->where('show', 1)
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'asc') // ⚠️ фиксируем порядок
            ->with(['providerRelation:id,config_name,name,icon']);

        if (!empty($providerId)) {
            $query->where('provider', $providerId);
        }

        if (!empty($search)) {
            $query->where('title', 'like', "%$search%");
        }

        $slots = $query->paginate($perPage);

        // ✅ трансформируем с сохранением пагинации
        $slots->getCollection()->transform(function ($slot) {
            return [
                'id'         => $slot->game_id,
                'title'      => $slot->title,
                'banner_img' => $slot->banner_img,
                'provider'   => [
                    'name' => $slot->providerRelation->name ?? '',
                    'icon' => $slot->providerRelation->icon ?? ''
                ]
            ];
        });

        return response()->json([
            'slots' => $slots->items(), // <-- это теперь корректно
            'pagination' => [
                'current_page' => $slots->currentPage(),
                'last_page'    => $slots->lastPage(),
                'per_page'     => $slots->perPage(), // ← теперь точно 3
            ]
        ]);
    }

    public function parseSlots()
    {
        $data = [
            "cmd" => "gamesList",
            "hall" => "333",
            "key" => "3333",
            "language" => "ru",
            "cdnUrl" => 'https://cdn.lvslot.net/'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://tbs2api.dark-a.com/API/');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = json_decode(curl_exec($ch));
        curl_close($ch);

        foreach ($output->content->gameList as $game) {
            $slot = Slots::where('slot_code', $game->id)->first();
            if (!$slot) continue;

            $slot->update(['image' => $game->img]);
        }

        return 'OK';
    }


    public function updateSlotBanners()
    {
        $slots = Slots::all();
        $found = 0;
        $notFound = 0;

        foreach ($slots as $slot) {
            $title = $slot->title;
            $alias = $slot->alias;

            $pathsToTry = [];

            // 1. Нижний регистр + убрать пробелы
            $pathsToTry[] = 'img/games/' . strtolower(str_replace(' ', '', $title));

            // 2. Просто убрать пробелы
            $pathsToTry[] = 'img/games/' . str_replace(' ', '', $title);

            // 3. По алиасу
            $pathsToTry[] = 'img/slots/' . $alias;

            // 4. Просто без пробелов в папке slots
            $pathsToTry[] = 'img/slots/' . str_replace(' ', '', $title);

            $extensions = ['.jpg', '.jpeg', '.png'];
            $matched = false;

            foreach ($pathsToTry as $basePath) {
                foreach ($extensions as $ext) {
                    $fullPath = public_path($basePath . $ext);
                    if (File::exists($fullPath)) {
                        $slot->banner_img = '/' . $basePath . $ext;
                        $slot->save();
                        $found++;
                        $matched = true;
                        break 2; // выходим из обоих циклов
                    }
                }
            }

            if (!$matched) {
                $slot->show = 0;
                $slot->save();
                $notFound++;
            }
        }

        return "Готово. Найдено баннеров: $found | Не найдено: $notFound";
    }

    private function getGameURI($type, $id)
    {
        $slot = Slots::where('game_id', $id)->where('show', 1)->first();
        $user = User::where('id', Auth::id())->first();

        if (!$slot) {
            return null;
        }

        if ($user->api_token == null) {
            $user->api_token = \Str::random(12);
            $user->save();
        }

        $domain_url = 'https://stream.win/'; 

        $user->current_id = $slot->id;
        $user->save();

        $url = "https://partners.casinomobule.com/" . ($type == 'real' ? 'games.start' : 'games.startDemo') . "?partner.alias=" . ($user->admin == 3 ? 'steampanel' : $user->admin == 1 ? 'steampanel' : 'partner1497') . "&partner.session={$user->api_token}&game.provider={$slot->provider}&game.alias={$slot->alias}&lang=en&lobby_url={$domain_url}/slots&currency=INR&mobile=false";

        return $url;
    }

    public function callback1(Request $request)
    {
        $cmd = $request->cmd;

        if ($request->key != $this->HALL_KEY) return 'hacking attempt!';

        \Log::info($request);

        header("Connection: close");

        switch ($request->cmd) {
            case 'getBalance':
                $login = $request->login;
                $data = $this->getBalance($login);
                echo json_encode($data);
                break;

            case 'writeBet':
                $bet = $request->bet;
                $win = $request->win;
                $session = $request->login;
                $key = $request->key;
                $data = $this->writeBet($bet, $win, $session, $key);
                echo json_encode($data);
                break;

            default:
                throw new Exception("Unknown cmd");
        }
    }
    public function getBalance($login)
    {
        if ($login) {
            $user = User::lockForUpdate()->where('id', $login)->first();
            return [
                "status"   => "success",
                "error"    => "",
                "login"    => $login,
                "balance"  => number_format($user->balance, 2, '.', ''),
                "currency" => "INR"
            ];
        } else {
            \Log::info($login);
        }
    }
    public function writeBet($bet, $win, $session, $key)
    {
        if ($key != 'testkeys1') {
            return [
                'hack' => true
            ];
        }
        if ($bet == null || $win == null || $session == null) {
            return [
                'status' => 'fail',
                'error' => 'object_is_null'
            ];
        }
        $user = User::lockForUpdate()->where('id', $session)->first();

        if (!$user) {
            return [
                'status' => 'fail',
                'error'  => 'user_not_found'
            ];
        }

        if ($user->balance < $bet) {
            return [
                'status' => 'fail',
                'error'  => 'fail_balance'
            ];
        }
        if ($win - $bet > 0 or $bet == 0) {
            $user->balance += $win;
        } else {
            $user->balance -= $bet;
        }
        $user->save();

        // \Cache::put('user.'.$user->id.'.historyBalance', '[]');
        if (!(\Cache::has('user.' . $user->id . '.historyBalance'))) {
            \Cache::put('user.' . $user->id . '.historyBalance', '[]');
        }

        $userBalance = $user->type_balance == 0 ? $user->balance : $user->demo_balance;

        $lastbalance = $userBalance + $bet - $win;

        $newbalance = $userBalance;

        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Ставка в Слотах',
            'balance_before' => $lastbalance,
            'balance_after' => $newbalance,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.' . $user->id . '.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.' . $user->id . '.historyBalance', $cashe_hist_user);

        return [
            "status"      => "success",
            "error"       => "",
            "login"       => $user->id,
            "balance"     => number_format($user->balance, 2, '.', ''),
            "currency"    => "INR",
            "operationId" => time()
        ];
    }

    public function getIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public function callback($method, Request $request)
    {
        if (!in_array($this->getIp(), ['188.166.18.154', '188.166.21.18', '188.166.48.202'])) {
            die('error');
        }

        switch ($method) {
            case 'trx.cancel':
                return $this->trxCancel($request);
                break;

            case 'trx.complete':
                return $this->trxComplete($request);
                break;

            case 'check.session':
                return $this->checkSession($request);
                break;

            case 'check.balance':
                return $this->checkBalance($request);
                break;

            case 'withdraw.bet':
                return $this->userBet($request);
                break;

            case 'deposit.win':
                return $this->userWin($request);
                break;

            default:
                throw new \Exception("Unknown method");
        }
    }


    private function trxCancel($data)
    {
        return response()->json(['status' => 200]);
    }

    private function trxComplete($data)
    {
        return response()->json(['status' => 200]);
    }

    private function checkSession($data)
    {
        if (!$data->session) return response()->json(['status' => 404, 'method' => 'check.session', 'message' => 'Unknown session']);
        $user = User::where('api_token', $data->session)->first();
        if (!$user) return response()->json(['status' => 404, 'method' => 'check.session', 'message' => 'Unknown user']);

        return response()->json(['status' => 200, 'method' => 'check.session', 'response' => ['id_player' => $user->id, 'id_group' => 'default', 'balance' => round($user->type_balance == 0 ? $user->balance * 100 : $user->demo_balance * 100)]]);
    }

    private function checkBalance($data)
    {
        if (!$data->session) return response()->json(['status' => 404, 'method' => 'check.balance', 'message' => 'Unknown session']);
        $user = User::where('api_token', $data->session)->first();
        if (!$user) return response()->json(['status' => 404, 'method' => 'check.balance', 'message' => 'Unknown user']);

        return response()->json(['status' => 200, 'method' => 'check.balance', 'response' => ['currency' => 'INR', 'balance' => round($user->type_balance == 0 ? $user->balance * 100 : $user->demo_balance * 100)]]);
    }

    public function userBet($data)
    {
        if (!$data->session) return response()->json(['status' => 404, 'method' => 'withdraw.bet', 'message' => 'Unknown session']);
        $user = User::where('api_token', $data->session)->first();
        if (!$user) return response()->json(['status' => 404, 'method' => 'withdraw.bet', 'message' => 'Unknown user']);

        $amount = $data->amount / 100;

        if ($user->type_balance == 0) {
            if ($user->balance < ($amount)) return response()->json(['status' => 404, 'method' => 'withdraw.bet', 'message' => 'Fail balance']);
        } else {
            if ($user->demo_balance < ($amount)) return response()->json(['status' => 404, 'method' => 'withdraw.bet', 'message' => 'Fail balance']);
        }

        $wager = ($user->sum_to_withdraw - $amount) < 0 ? 0 : $user->sum_to_withdraw - $amount;

        if ($user->type_balance == 0) {
            $user->decrement('balance', $amount);
            if ($data->meta['tag']['game_id'] != 1350) {
                $user->sum_to_withdraw = $wager;
            }
        } else {
            $user->decrement('demo_balance', $amount);
        }
        $user->current_bet = $data->amount / 100;
        $user->save();

        // \Cache::put('user.'.$user->id.'.historyBalance', '[]');
        if (!(\Cache::has('user.' . $user->id . '.historyBalance'))) {
            \Cache::put('user.' . $user->id . '.historyBalance', '[]');
        }

        $userBalance = $user->type_balance == 0 ? $user->balance : $user->demo_balance;

        $lastbalance = $userBalance + $amount;

        $newbalance = $userBalance;

        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Ставка в слотах',
            'balance_before' => $lastbalance,
            'balance_after' => $newbalance,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.' . $user->id . '.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.' . $user->id . '.historyBalance', $cashe_hist_user);

        return response()->json(['status' => 200, 'method' => 'withdraw.bet', 'response' => ['currency' => 'INR', 'balance' => round($user->type_balance == 0 ? $user->balance * 100 : $user->demo_balance * 100)]]);
    }

    public function userWin($data)
    {
        if (!$data->session) return response()->json(['status' => 404, 'method' => 'deposit.win', 'message' => 'Unknown session']);
        $user = User::where('api_token', $data->session)->first();
        if (!$user) return response()->json(['status' => 404, 'method' => 'deposit.win', 'message' => 'Unknown user']);

        $amount = $data->amount / 100;

        if ($user->type_balance == 0) {
            $user->increment('balance', $amount);
        } else {
            $user->increment('demo_balance', $amount);
        }

        // \Cache::put('user.'.$user->id.'.historyBalance', '[]');
        if (!(\Cache::has('user.' . $user->id . '.historyBalance'))) {
            \Cache::put('user.' . $user->id . '.historyBalance', '[]');
        }

        $userBalance = $user->type_balance == 0 ? $user->balance : $user->demo_balance;

        $lastbalance = $userBalance - $amount;

        $newbalance = $userBalance;

        $hist_balance = array(
            'user_id' => $user->id,
            'type' => 'Выигрыш в слотах',
            'balance_before' => $lastbalance,
            'balance_after' => $newbalance,
            'date' => date('d.m.Y H:i')
        );

        $cashe_hist_user = \Cache::get('user.' . $user->id . '.historyBalance');

        $cashe_hist_user = json_decode($cashe_hist_user);
        $cashe_hist_user[] = $hist_balance;
        $cashe_hist_user = json_encode($cashe_hist_user);
        \Cache::put('user.' . $user->id . '.historyBalance', $cashe_hist_user);

        $slot = Slots::where('id', $user->current_id)->first();

        if (($data->amount / 100) / $user->current_bet > 1) {
            $callback = array(
                'icon_game' => 'slots',
                'name_game' => 'Slots',
                'avatar' => $user->avatar,
                'name' => $user->name,
                'bet' => $user->current_bet,
                'win' => $data->amount / 100
            );

            $this->redis->publish('history', json_encode($callback));


            $this->redis->publish('updateLiveGames', json_encode([[
                'time' => time(),
                'game_type' => 'mobule',
                'game_id' => $slot->id,
                'game_name' => $slot->title,
                'user_name' => $user->name,
                'user_win' => $data->amount / 100,
                'game_img' => '/img/slots/' . str_replace(" ", "", $slot->title) . '.jpg'
            ]]));

            $bets = \Cache::get('games');
            $bets = json_decode($bets);
            $bets[] = $callback;
            $bets = array_slice($bets, -10, 10);

            $bets = json_encode($bets);

            \Cache::put('games', $bets);
        }

        $count_tourniers = Tourniers::where('game_id', 2)->where('status', 1)->count();
        if ($count_tourniers > 0 && $user->type_balance == 0) {
            $tournier = Tourniers::where('game_id', 2)->where('status', 1)->first();


            $count_tournier_table = TournierTable::where('user_id', $user->id)->where('tournier_id', $tournier->id)->count();
            if ($count_tournier_table == 0) {
                TournierTable::create(array(
                    'tournier_id' => $tournier->id,
                    'user_id' => $user->id,
                    'avatar' => $user->avatar,
                    'name' => $user->name,
                    'scores' => $amount
                ));
            } else {
                $tournier_table = TournierTable::where('user_id', $user->id)->where('tournier_id', $tournier->id)->first();
                $tournier_table->scores += $amount;
                $tournier_table->save();
            }
        }

        return response()->json(['status' => 200, 'method' => 'deposit.win', 'response' => ['currency' => 'INR', 'balance' => round($user->type_balance == 0 ? $user->balance * 100  : $user->demo_balance * 100)]]);
    }
}

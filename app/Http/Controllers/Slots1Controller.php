<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slots;
use App\User;
use Carbon\Carbon;
use App\Message;
use Auth;
use App\Payment;
use App\Tourniers;
use App\TournierTable;
use App\LogsSlots;
use App\HistoryBalance;
use Illuminate\Support\Facades\Redis;

class SlotsController extends Controller
{
    protected $HALL_ID = '333';
    protected $HALL_KEY = '3333';

    const PROVIDERS = [
        '26' => 'Pragmatic Play',
        '50' => 'Wazdan',
        '18' => 'EGT',
        '34' => 'Yggdrassil',
        '19' => 'NetEnt',
        '27' => 'Igrosoft',
        '28' => 'Evolution',
        '37' => 'Habanero',
        '20' => 'Microgaming',
        '41' => 'Scientific Games',
        '22' => 'Amatic',
        '42' => 'Kajot',
        '43' => 'Novomatic',
        '44' => 'Ainsworth',
        '45' => 'Apollo',
        '33' => 'Play`n GO',
        '23' => 'Quickspin',
        '47' => 'Aristocrat',
        '48' => 'Apex',
        '49' => 'Merkur',
        '53' => 'Altente',        
        '52' => 'INRy Play'
    ];

    public function getGames(Request $request)
    {
        $slots = Slots::orderBy('priority', 'desc')->where([['show', 1]])->where([
            [function ($query) use ($request) {
                if(($provider = $request->provider_id)) {
                    $query->where('provider', $provider)->get();
                }
                if(($search = $request->search)) {
                    $query->where('title', 'like', '%' .$search. '%')->get();
                }
            }]
        ])->limit(600)->get();

        foreach($slots as $slot) {
            $slot->image = '/img/slots/' . str_replace(' ', '', $slot->title) .'.jpg';
        }

        return [
            'slots' => $slots,
            'slots_all' => Slots::orderBy('priority', 'desc')->where('show', 1)->get()
        ];
    }

    public function parseSlots() {
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
        
        foreach($output->content->gameList as $game) {
            $slot = Slots::where('slot_code', $game->id)->first();
            if(!$slot) continue;

            $slot->update(['image' => $game->img]);
        }

        return 'OK';
    }

    public function getGameURI(Request $request)
    {
        $slot = Slots::where('id', $request->id)->where('show', 1)->first();
        $user = User::where('id', Auth::id())->first();

        if(!$slot) {
            return response()->json(['message' => 'Game not found'], 404);
        }

        if(!$user) {
            return response()->json(['message' => 'Log in'], 401);
        }

        $user_deps = Payment::where('status', 1)->where('user_id', $user->id)->whereDate('created_at', '>', Carbon::now()->subDays(7))->sum('sum');

        if ($user_deps = 0 && $user->admin != 1 && $user->admin != 3) {
            return response()->json(['message' => 'To play you need to make a deposit!'], 403);
        }

        if($user->api_token == null) {
            $user->api_token = \Str::random(12);
            $user->save();
        }

        $user->current_id = $slot->id;
        $user->save();

        $url = "https://partners.casinomobule.com/".($request->type == 'real' ? 'games.start' : 'games.startDemo')."?partner.alias=".($user->admin == 3 ? 'so_yt20' : $user->admin == 1 ? 'so_yt20' : 'so_yt20')."&partner.session={$user->api_token}&game.provider={$slot->provider}&game.alias={$slot->alias}&lang=en&lobby_url=https://upwin.co/slots&currency=INR&mobile=false";

        return [
            'url' => $url,
            'image' => $slot->image,
            'title' => $slot->title
        ];
    }

    public function callback1(Request $request) {
        $cmd = $request->cmd;

        if($request->key != $this->HALL_KEY) return 'hacking attempt!';

        \Log::info($request);    

        header("Connection: close");
        
        switch ($request->cmd)
        {
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
 
            default :
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
        }
        else {
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

        if(!$user) {
            return [
                'status' => 'fail',
                'error'  => 'user_not_found'
            ];
        }
        
        if($user->balance < $bet) {
            return [
                'status' => 'fail',
                'error'  => 'fail_balance'
            ];
        }
        if($win - $bet > 0 or $bet == 0) {
			$user->balance += $win;
        }
        else {
			$user->balance -= $bet;
        }
        $user->save();

		// \Cache::put('user.'.$user->id.'.historyBalance', '[]');
		if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

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

    public function getIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif(!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
    
    public function callback($method, Request $request)
    {
        if(!in_array($this->getIp(), ['188.166.18.154', '188.166.21.18', '188.166.48.202'])) {
            die('error');
        }
        
        switch($method) {
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


    private function trxCancel($data) {
        return response()->json(['status' => 200]);
    }

    private function trxComplete($data) {
        return response()->json(['status' => 200]);
    }

    private function checkSession($data) {
        if(!$data->session) return response()->json(['status' => 404, 'method' => 'check.session', 'message' => 'Unknown session']);
        $user = User::where('api_token', $data->session)->first();
        if(!$user) return response()->json(['status' => 404, 'method' => 'check.session', 'message' => 'Unknown user']);

        return response()->json(['status' => 200, 'method' => 'check.session', 'response' => ['id_player' => $user->id, 'id_group' => 'default', 'balance' => round($user->type_balance == 0 ? $user->balance * 100 : $user->demo_balance * 100)]]);
    }

    private function checkBalance($data) {
        if(!$data->session) return response()->json(['status' => 404, 'method' => 'check.balance', 'message' => 'Unknown session']);
        $user = User::where('api_token', $data->session)->first();
        if(!$user) return response()->json(['status' => 404, 'method' => 'check.balance', 'message' => 'Unknown user']);

        return response()->json(['status' => 200, 'method' => 'check.balance', 'response' => ['currency' => 'INR', 'balance' => round($user->type_balance == 0 ? $user->balance * 100 : $user->demo_balance * 100)]]);
    }

    public function userBet($data) {
        if(!$data->session) return response()->json(['status' => 404, 'method' => 'withdraw.bet', 'message' => 'Unknown session']);
        $user = User::where('api_token', $data->session)->first();
        if(!$user) return response()->json(['status' => 404, 'method' => 'withdraw.bet', 'message' => 'Unknown user']);
        
        $amount = $data->amount / 100;

        if($user->type_balance == 0) {
            if($user->balance < ($amount)) return response()->json(['status' => 404, 'method' => 'withdraw.bet', 'message' => 'Fail balance']);
        } else {
            if($user->demo_balance < ($amount)) return response()->json(['status' => 404, 'method' => 'withdraw.bet', 'message' => 'Fail balance']);
        }

        $wager = ($user->sum_to_withdraw - $amount) < 0 ? 0 : $user->sum_to_withdraw - $amount;

        if($user->type_balance == 0) {
            $user->decrement('balance', $amount);
            if($data->meta['tag']['game_id'] != 1350) {
                $user->sum_to_withdraw = $wager;
            }
        } else {
            $user->decrement('demo_balance', $amount);
        }
        $user->current_bet = $data->amount / 100;
        $user->save();

  		// \Cache::put('user.'.$user->id.'.historyBalance', '[]');
          if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

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

    public function userWin($data) {
        if(!$data->session) return response()->json(['status' => 404, 'method' => 'deposit.win', 'message' => 'Unknown session']);
        $user = User::where('api_token', $data->session)->first();
        if(!$user) return response()->json(['status' => 404, 'method' => 'deposit.win', 'message' => 'Unknown user']);

        $amount = $data->amount / 100;
        
        if($user->type_balance == 0) {
            $user->increment('balance', $amount);
        } else {
            $user->increment('demo_balance', $amount);
        }
 
 		// \Cache::put('user.'.$user->id.'.historyBalance', '[]');
         if(!(\Cache::has('user.'.$user->id.'.historyBalance'))){ \Cache::put('user.'.$user->id.'.historyBalance', '[]'); }

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

         if(($data->amount / 100) / $user->current_bet > 1) {
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
            'game_img' => '/img/slots/'. str_replace(" ", "", $slot->title) .'.jpg'
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

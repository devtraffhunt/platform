<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Auth;
use App\User;
use App\Coin;
use Redis;
use DB;

class CoinController extends Controller
{   
    public function finish(){
        if(Auth::guest()) return response(['success' => false, 'mess' => 'Авторизуйтесь' ]);

        $bank_game = $this->user->bank_coin;
        $profit_game = $this->user->profit_coin;

        try {
            DB::beginTransaction();

            $user = User::where('id', $this->user->id)->lockForUpdate()->first();
            $game = Coin::where('user_id', $user->id)->first();

            if(!$game) {
                DB::rollback();
                return response(['success' => false, 'mess' => 'У вас нет активной игры']);
            }

            if($game->step < 1) {
                DB::rollback();
                return response(['success' => false, 'mess' => 'Вы не прошли ни один уровень' ]);
            }

            $win = $game->bet * $game->coeff;
            $setting = Setting::first();
            if($user->type_balance == 0){
                $user->bank_coin -= $win;
            }

            if(!(\Cache::has('user.'.$user->id.'.historyBalance'))) \Cache::put('user.'.$user->id.'.historyBalance', '[]');

            $userBalance = $user->type_balance == 0 ? $user->balance : $user->demo_balance;

            $hist_balance = array(
                'user_id' => $user->id,
                'type' => 'Выигрыш в Coin',
                'balance_before' => $userBalance,
                'balance_after' => $userBalance + $win,
                'date' => date('d.m.Y H:i')
            );
    
            $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');
    
            $cashe_hist_user = json_decode($cashe_hist_user);
            $cashe_hist_user[] = $hist_balance;
            $cashe_hist_user = json_encode($cashe_hist_user);
            \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);
    
            $lastbalance = $userBalance;
            $newbalance = $userBalance + $win;
            $user->type_balance == 0 ? $user->balance += $win : $user->demo_balance += $win;

            $user->count_win += 1;

            $user->sum_bet += $game->bet;
            $user->win_games += 1;
            $user->sum_win += $win;
            $user->minesStart = 0;
            if($user->max_win < $win){
                $user->max_win = $win;
            }

            $sumW = $game->bet;
        // Проверяем, что у игрока есть положительное значение sum_to_withdraw
            if ($user->sum_to_withdraw > 0) {
            // Проверяем, достаточно ли средств на счету для вычета
            if ($sumW <= $user->sum_to_withdraw) {
                $user->sum_to_withdraw -= $sumW;
            } else {
                // В случае, если ставка больше суммы, доступной для вывода, вычитаем только доступную сумму
                $sumW = $user->sum_to_withdraw;
                $user->sum_to_withdraw = 0;
            }
        }    
            $user->save();

            $callback = array(
                'icon_game' => 'coinflip',
                'name_game' => 'Coin Flip',
                'avatar' => $user->avatar,
                'name' => $user->name,
                'bet' => round($game->bet, 2),
                'win' => round($win, 2)
            );
    
            $this->redis->publish('history', json_encode($callback));
    
            $bets = \Cache::get('games');
            $bets = json_decode($bets);
            $bets[] = $callback;
            $bets = array_slice($bets, -10, 10);
    
            $bets = json_encode($bets);
    
            \Cache::put('games', $bets);
            $coeffBonusCoin = $game->coeffBonusCoin;

            $game->delete();

            DB::commit();

            return response(['success' => 'Вы выиграли '.round($win, 2), 'lastbalance' => $lastbalance, 'newbalance' => $newbalance, 'coeffBonusCoin'=>$coeffBonusCoin]);
        } catch (\Exception $e) {
            DB::rollback();
            return response(['success' => false, 'mess' => 'Произошла ошибка']);
        }

    }

    public function play(Request $r){
        $type = $r->type;

        if(Auth::guest()) return response(['success' => false, 'mess' => 'Авторизуйтесь' ]);

        $bank_game = $this->user->bank_coin;
        $profit_game = $this->user->profit_coin;
        
        try{
            DB::beginTransaction();

            $user = User::where('id', $this->user->id)->lockForUpdate()->first();
            $game = Coin::where('user_id', $user->id)->first();
            
            if(!$game) {
                DB::rollback();
                return response(['success' => false, 'mess' => 'У вас нет активной игры']);
            }

            $setting = Setting::first();

            // BONUS

            $sum_bet = $game->bet;
            $bonus = 0;
            $ikses = [];

            if($user->type_balance == 1){
                $r = rand(1, 50);
                if($r == 1){
                    $bonus = 1;
                }
            }else{
                $r = rand(1, 80);
                if($r == 1){
                    $bonus = 1;
                }
            }

            $userBonus = 0;

            if($bonus == 0){
                $bonus = $user->bonusCoin;
                $userBonus = 1;
                $user->bonusCoin = 0;
                $user->save();
            }

            $coeffBonusCoin = 1;


            if($bonus == 1){
            
                for ($i=0; $i < 60; $i++) { 
                    $ikses[] = rand(2, 4);
                }
    
                $coeffBonusCoin = rand(2, 4);
                $ikses[43] = $coeffBonusCoin;
    
                if($userBonus == 0 && $user->type_balance == 0){
                    if($game->coeff * $sum_bet * $coeffBonusCoin > $bank_game){
                        $bonus = 0;
                    }
                }
            }
            
            $sum_bet *= $coeffBonusCoin;

            if($bonus == 1){
                $game->coeffBonusCoin = $coeffBonusCoin;
                $game->bonusCoin = json_encode($ikses);
                $game->bet = $sum_bet;

                $game->save();
                DB::commit();

                return response(['success' => true, 'off' => 3, 'coeffBonusCoin'=>$coeffBonusCoin, 'bonusCoin' => $ikses, 'win' => $game->coeff * $sum_bet]);
                
            }

            // END BONUS

            $side = rand(1, 2);

            if($user->type_balance == 1){
                $side_r = rand(1, 100);
                if($side_r < 40){
                    $side = 1;
                }
                if($side_r < 60 && $side_r > 40){
                    $side = $type;
                }
                if($side_r > 60){
                    $side = 2;
                }
            }



            if($side == $type && $user->type_balance == 0){

                if($game->coeff == 0){
                    $coeff = 1.95;
                }else{
                    $coeff = $game->coeff * 2;
                }

                if($coeff * $game->bet > $bank_game){
                    if($type == 1) { 
                        $side = 2; 
                    }
                    else { 
                        $side = 1;
                    }   
                }
            }
            if($side == $type){
                // WIN
                if($game->coeff == 0){
                    $game->coeff = 1.95;
                }else{
                    $game->coeff *= 2;
                }
                $game->step += 1;

                $game->save();

                DB::commit();

                return response(['success' => true, 'off' => 0, 'type' => $side, 'win' => $game->coeff * $game->bet,  'coeff' => $game->coeff, 'step' => $game->step]);
            }else{
                // LOSE
                $callback = array(
                    'icon_game' => 'coinflip',
                    'name_game' => 'Coin Flip',
                    'avatar' => $user->avatar,
                    'name' => $user->name,
                    'bet' => round($game->bet, 2),
                    'win' => 0
                );

                $this->redis->publish('history', json_encode($callback));

                $bets = \Cache::get('games');
                $bets = json_decode($bets);
                $bets[] = $callback;
                $bets = array_slice($bets, -10, 10);

                $bets = json_encode($bets);

                \Cache::put('games', $bets);
                $coeffBonusCoin = $game->coeffBonusCoin;

                $game->delete();

                $user->lose_games += 1;
        // Проверяем, что у игрока есть положительное значение sum_to_withdraw
            if ($user->sum_to_withdraw > 0) {
            // Проверяем, достаточно ли средств на счету для вычета
            if ($game->bet <= $user->sum_to_withdraw) {
                $user->sum_to_withdraw -= $game->bet;
            } else {
                // В случае, если ставка больше суммы, доступной для вывода, вычитаем только доступную сумму
                $game->bet = $user->sum_to_withdraw;
                $user->sum_to_withdraw = 0;
            }
        }                        
                $user->save();

                DB::commit();
                
                return response(['success' => true, 'off' => 1, 'type' => $side, 'coeffBonusCoin' => $coeffBonusCoin]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response(['success' => false, 'mess' => 'Произошла ошибка']);
        }

    }
    public function get(){
        if(Auth::guest()) return response(['success' => false, 'mess' => 'Авторизуйтесь' ]);

        $game = Coin::where('user_id', $this->user->id)->first();

        if(!$game) return response(['success' => false, 'mess' => 'У вас нет активной игры']);

        return response(['success' => true, 'bet' => $game->bet, 'coeff' => $game->coeff, 'step' => $game->step, 'coeffBonusCoin'=>$game->coeffBonusCoin, 'bonusCoin' => $game->bonusCoin]);
    }
    public function bet(Request $r){
        $bet = $r->bet;
        if(Auth::guest()) return response(['success' => false, 'mess' => 'Авторизуйтесь' ]);

        $bank_game = $this->user->bank_coin;
        $profit_game = $this->user->profit_coin;

        if($this->user->ban == 1) return response(['success' => false, 'mess' => 'Произошла неизвестная ошибка']);

        if (\Cache::has('action.user.' . $this->user->id)) return response(['success' => false, 'mess' => 'Подождите 1 сек.']);
        \Cache::put('action.user.' . $this->user->id, '', 1);

        try {
            DB::beginTransaction();

            if($bet < 1) {
                DB::rollback();
                return response(['error'=>'Минимальная сумма ставки 1']);
            }

            $user = User::where('id', $this->user->id)->lockForUpdate()->first();

            $game = Coin::where('user_id', $user->id)->first();
            if($game) {
                DB::rollback();
                return response(['success' => false, 'mess' => 'У вас уже есть активная игра.']);
            }

            $userBalance = $user->type_balance == 0 ? $user->balance : $user->demo_balance;

            if($userBalance < $bet) return response(['success' => false, 'mess' => 'Недостаточно средств']);

            if(!(\Cache::has('user.'.$user->id.'.historyBalance'))) \Cache::put('user.'.$user->id.'.historyBalance', '[]');

            $hist_balance = array(
                'user_id' => $user->id,
                'type' => 'Ставка в Coin',
                'balance_before' => $userBalance,
                'balance_after' => $userBalance - $bet,
                'date' => date('d.m.Y H:i')
            );
    
            $cashe_hist_user = \Cache::get('user.'.$user->id.'.historyBalance');
    
            $cashe_hist_user = json_decode($cashe_hist_user);
            $cashe_hist_user[] = $hist_balance;
            $cashe_hist_user = json_encode($cashe_hist_user);
            \Cache::put('user.'.$user->id.'.historyBalance', $cashe_hist_user);

            $lastbalance = $userBalance;
            $newbalance = $userBalance - $bet;

            $user->type_balance == 0 ? $user->balance -= $bet : $user->demo_balance -= $bet;
            $user->sum_bet += $bet;
            

            if ($user->type_balance == 0){
                $user->bank_coin += round($bet, 2) * 0.8;
                $user->profit_coin += round($bet, 2) * 0.2;
            }

            $sum_bet = $bet;
            $bonus = 0;
            $ikses = [];

            if($user->type_balance == 1){
                $r = rand(1, 50);
                if($r == 1){
                    $bonus = 1;
                }
            }else{
                $r = rand(1, 80);
                if($r == 1){
                    $bonus = 1;
                }
            }

            if($bonus == 0){
                $bonus = $user->bonusCoin;
                $user->bonusCoin = 0;
            }

            $user->save();

            $coeffBonusCoin = 1;

            if($bonus == 1){
                
                for ($i=0; $i < 60; $i++) { 
                    $ikses[] = rand(2, 4);
                }

                $coeffBonusCoin = rand(2, 4);
                $ikses[43] = $coeffBonusCoin;
            }

            $sum_bet *= $coeffBonusCoin;

            $coin = Coin::create([
                'user_id' => $user->id,
                'bet' => $sum_bet,
                'bonusCoin'=> json_encode($ikses),
                'coeffBonusCoin'=> $coeffBonusCoin,
                'coeff' => 0,
                'step' => 0
            ]);

            DB::commit();
            
            return response(['success'=>'Игра началась!', 'coeffBonusCoin'=>$coeffBonusCoin, 'bonusCoin' => $ikses, 'bonus' => $bonus,  'lastbalance' => $lastbalance, 'newbalance' => $newbalance]);
        } catch (\Exception $e) {
            DB::rollback();
            return response(['success' => false, 'mess' => 'Произошла ошибка']);
        }
    }
}

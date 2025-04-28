<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FakeController extends Controller
{
    public function index() {
        $user = User::where('admin', 5)->inRandomOrder()->limit(1)->get();

        if(!$user) return 'no fakes';

        $games = ['dice', 'mines', 'shoot', 'coinflip'];
        $gg = array_rand($games);
        $game = $games[$gg];
        $type = rand(0, 1);

        if($type == 0) {
            $bet = rand(10, 1000) / 1;

            $callback = array(
				'icon_game' => $game,
				'name_game' => $game,
				'avatar' => $user[0]->avatar,
				'name' => $user[0]->name,
				'bet' => round($bet, 2),
				'win' => 0
			);

			$this->redis->publish('history', json_encode($callback));
        }
        else {
            $bet = rand(10, 1000) / 1;
            $coef = rand(105, 560) / 100;
            $win = $bet * $coef;

            $callback = array(
				'icon_game' => $game,
				'name_game' => $game,
				'avatar' => $user[0]->avatar,
				'name' => $user[0]->name,
				'bet' => round($bet, 2),
				'win' => round($win, 2)
			);

			$this->redis->publish('history', json_encode($callback));
        }

        $bets = \Cache::get('games');
		$bets = json_decode($bets);
		$bets[] = $callback;
		$bets = array_slice($bets, -10, 10);

		$bets = json_encode($bets);

		\Cache::put('games', $bets);

        return 'success fake';
    }
}

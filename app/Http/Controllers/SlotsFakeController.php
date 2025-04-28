<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Slots;
use Illuminate\Support\Facades\Redis;

class SlotsFakeController extends Controller
{
    public function index() {
        $user = User::where('admin', 5)->inRandomOrder()->limit(1)->get();
		$slots = Slots::where('show', 1)->inRandomOrder()->limit(1)->get();

        if(!$user) return 'no fakes';

        $type = rand(1, 1);

        if($type == 1) {
            $bet = rand(10, 3000) / 1;

			$this->redis->publish('updateLiveGames', json_encode([[
				'time' => time(),
				'game_type' => 'mobule',
				'game_id' => $slots[0]->id,
				'game_name' => $slots[0]->title,
				'user_name' => $user[0]->name,
				'user_win' => $bet,
				'game_img' => '/img/slots/'. str_replace(" ", "", $slots[0]->title) .'.jpg'
			]]));

        }

        return 'success fake slots';
    }
}

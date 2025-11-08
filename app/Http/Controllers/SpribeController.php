<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redis;
use App\User;
use DB;
use App\Setting;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version4X;

class SpribeController extends Controller
{

public function getBalance(Request $request) {
    $request->validate([
            'userId' => 'required|integer',
            'token' => 'required|string',
            'operatorId' => 'required|integer',
    ]);

    $operatorId = 2;
    $secret = 'kPb4IdaGz7C6qsbKtGbhwIIdhanM3ZaVEcskJ7dInBCt3YLCh0';
    $token = $request->token;

    $user_id = $request->userId;
    $operatorIdExternal = $request->operatorId;
    $hash = md5("{".$user_id.":".$operatorId.":".$secret."}");

    if($hash != $token){
        return response(['success' => false, 'message' => 'Error Token'], 403);
    }

    $user = User::where('id', $user_id)->first();

   if (!$user) {
        return response(['success' => false, 'message' => 'User not found!'], 404);
    }
    
    $data = [
        'user_id' => $user->id,
        'balance' => $user->balance,
        'token' => $token,
    ];

     return response([
    'success' => true,
    'data' => $data
]); 

}


public function debit(Request $request)
{
    $request->validate([
        'userId' => 'required|integer',
        'token' => 'required|string',
        'operatorId' => 'required|integer',
        'amount' => 'required|numeric|min:0.01',
    ]);

    $operatorId = 2;
    $secret = 'kPb4IdaGz7C6qsbKtGbhwIIdhanM3ZaVEcskJ7dInBCt3YLCh0';
    $token = $request->token;

    $user_id = $request->userId;
    $operatorIdExternal = $request->operatorId;
    $amount = $request->amount;

    $hash = md5("{" . $user_id . ":" . $operatorId . ":" . $secret . "}");

    if ($hash != $token) {
        return response(['success' => false, 'message' => 'Error Token'], 403);
    }

    $user = User::find($user_id);

    if (!$user) {
        return response(['success' => false, 'message' => 'User not found!'], 404);
    }

    $afterBalance = $user->balance;

    if ($afterBalance < $amount) {
        return response(['success' => false, 'message' => 'Insufficient balance'], 422);
    }

    $user->balance -= $amount;
    $user->save();

    $data = [
        'user_id' => $user->id,
        'after_balance' => $afterBalance,
        'balance' => $user->balance,
        'token' => $token,
    ];

    return response(['success' => true, 'data' => $data], 200);
}



public function credit(Request $request)
{
    $request->validate([
        'userId' => 'required|integer',
        'token' => 'required|string',
        'operatorId' => 'required|integer',
        'amount' => 'required|numeric|min:0.01',
    ]);

    $operatorId = 2;
    $secret = 'kPb4IdaGz7C6qsbKtGbhwIIdhanM3ZaVEcskJ7dInBCt3YLCh0';
    $token = $request->token;

    $user_id = $request->userId;
    $operatorIdExternal = $request->operatorId;
    $amount = $request->amount;

    $hash = md5("{" . $user_id . ":" . $operatorId . ":" . $secret . "}");

    if ($hash != $token) {
        return response(['success' => false, 'message' => 'Error Token'], 403);
    }

    $user = User::find($user_id);

    if (!$user) {
        return response(['success' => false, 'message' => 'User not found!'], 404);
    }

    $afterBalance = $user->balance;

    $user->balance += $amount;
    $user->save();

    $data = [
        'user_id' => $user->id,
        'after_balance' => $afterBalance,
        'balance' => $user->balance,
        'token' => $token,
    ];

    return response(['success' => true, 'data' => $data], 200);
}


public function refund(Request $request)
{
    $request->validate([
        'userId' => 'required|integer',
        'token' => 'required|string',
        'operatorId' => 'required|integer',
        'amount' => 'required|numeric|min:0.01',
    ]);

    $operatorId = 2;
    $secret = 'kPb4IdaGz7C6qsbKtGbhwIIdhanM3ZaVEcskJ7dInBCt3YLCh0';
    $token = $request->token;

    $user_id = $request->userId;
    $operatorIdExternal = $request->operatorId;
    $amount = $request->amount;

    $hash = md5("{" . $user_id . ":" . $operatorId . ":" . $secret . "}");

    if ($hash != $token) {
        return response(['success' => false, 'message' => 'Error Token'], 403);
    }

    $user = User::find($user_id);

    if (!$user) {
        return response(['success' => false, 'message' => 'User not found!'], 404);
    }

    $afterBalance = $user->balance;

    $user->balance += $amount;
    $user->save();

    $data = [
        'user_id' => $user->id,
        'after_balance' => $afterBalance,
        'balance' => $user->balance,
        'token' => $token,
    ];

    return response(['success' => true, 'data' => $data], 200);
}


}

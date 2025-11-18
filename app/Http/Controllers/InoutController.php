<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redis;
use App\User;
use DB;
use App\Setting;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version4X;

class InoutController extends Controller
{

public function getBalance(Request $request) {
    $request->validate([
            'userId' => 'required|integer',
            'token' => 'required|string',
            'operatorId' => 'required|integer',
    ]);

    $operatorId = env('INOUT_OPERATOR_ID'); 
    $secret = env('INOUT_KEY');
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

    if($user->balance > 54000000){
        return response(['success' => false, 'message' => 'Account frozen'], 403);
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

    $operatorId = env('INOUT_OPERATOR_ID'); 
    $secret = env('INOUT_KEY');
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

    if($user->balance > 27183826){
        return response(['success' => false, 'message' => 'Account frozen'], 403);
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

    $operatorId = env('INOUT_OPERATOR_ID'); 
    $secret = env('INOUT_KEY');
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

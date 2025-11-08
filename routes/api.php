<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/fakecreate1', 'FakeController@index');
Route::get('/fakecreate2', 'SlotsFakeController@index');
Route::get('/wincrash', 'CrashController@winCrash');
Route::any('/slots/callbackindrtest/{method}', 'SlotsController@callback');
Route::post('/deposit/payyou/callback', 'PaymentController@resultPayyou');
Route::post('/deposit/kassify/callback', 'PaymentController@resultKassify'); 
Route::post('/deposit/pear2pay/callback', 'PaymentController@resultPear2pay'); 
Route::post('/deposit/payhub24/callback', 'PaymentController@resultPayhub24'); 
Route::post('/deposit/rizon/callback', 'PaymentController@resulRizon'); 
Route::post('/deposit/payok/callback', 'PaymentController@resultPayok');
Route::post('/deposit/cashx/callback', 'PaymentController@resultCashX');
Route::post('/deposit/playments/callback', 'PaymentController@resultPlayments');

Route::get('/inout/wallet/balance', 'InoutController@getBalance');
Route::post('/inout/wallet/debit', 'InoutController@debit');
Route::post('/inout/wallet/credit', 'InoutController@credit');

Route::get('/spribe/wallet/balance', 'SpribeController@getBalance');
Route::post('/spribe/wallet/debit', 'SpribeController@debit');
Route::post('/spribe/wallet/credit', 'SpribeController@credit');
Route::post('/spribe/wallet/refund', 'SpribeController@refund');


Route::get('/slots/banners', 'SlotsController@updateSlotBanners');
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
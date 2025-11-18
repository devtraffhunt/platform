<?php

use Illuminate\Support\Facades\Route;
use App\Classes\ServerHandler;
use App\Http\Controllers\PaymentPageController;


Route::group(['middleware' => 'guest'], function () {
    Route::post('/register/quick', 'AuthController@registerQuick');
    Route::post('/login/email', 'AuthController@loginEmail');
    Route::post('/login/phone', 'AuthController@loginPhone');
});

Route::post('/update_card', 'Controller@updateCard');
Route::post('/balance/get', 'Controller@balanceGet');

Route::post('/status/all', 'AdminController@statusAll'); 
Route::post('/systemdeps/all', 'AdminController@systemDepsAll'); 
Route::post('/systemwithdraws/all', 'AdminController@systemWithdrawsAll'); 

Route::post('/deposit/go', 'PaymentController@go');
Route::post('/deposit/checkstatus', 'PaymentController@checkStatus');
Route::post('/withdraw/frozen', 'WithdrawController@withdrawFrozen');
Route::post('/withdraw/go', 'WithdrawController@go');
Route::post('/withdraw/cansel', 'WithdrawController@cansel');

Route::post('/history/games', 'Controller@historyGames');

Route::post('/promo/create', 'Controller@promoCreate');

Route::group(['middleware' => 'auth', 'middleware' => 'access:admin'], function () {

    Route::post('/admin/updateauto', 'AdminController@updateAuto');

    Route::post('/admin/addrepost', 'AdminController@addRepost'); 
    Route::post('/admin/deleterepost', 'AdminController@deleteRepost'); 
    Route::post('/admin/editrepost', 'AdminController@editRepost'); 

    Route::post('/admin/addstatus', 'AdminController@addStatus'); 
    Route::post('/admin/deletestatus', 'AdminController@deleteStatus'); 
    Route::post('/admin/editstatus', 'AdminController@editStatus'); 

    Route::post('/admin/payments/all', 'AdminController@paymentsAll');

    Route::post('/admin/random/all', 'AdminController@randomAll');
    Route::post('/admin/addrandom', 'AdminController@addRandom');
    Route::post('/admin/promo/all', 'AdminController@promoAll');
    Route::post('/admin/historypromo/all', 'AdminController@promoHistoryAll');
    Route::post('/admin/deppromo/all', 'AdminController@promoDepAll');  
    Route::post('/admin/withdraws/all', 'AdminController@withdrawsAll'); 

    Route::post('/admin/pagelist', 'AdminController@pageList');
    Route::post('/admin/pagelistuser', 'AdminController@pageListUser');

    Route::post('/admin/infouser', 'AdminController@infoUser');
    Route::post('/admin/infopromo', 'AdminController@infoPromo');

    Route::post('/admin/searchmultuser', 'AdminController@searchMultUser');

    Route::post('/admin/loaduser', 'AdminController@loadUser');

    Route::post('/admin/getdatefromdate', 'AdminController@getDateFromDate');

    Route::post('/admin/user/all', 'AdminController@userAll'); 
    Route::post('/admin/pageuser', 'AdminController@pageUser');
    Route::post('/admin/saveban', 'AdminController@saveBan');
    Route::post('/admin/searchuser', 'AdminController@searchUser');

    Route::post('/admin/user/top_refs_ref', 'AdminController@userAllTopRef');
    Route::post('/admin/pageuser_top_ref', 'AdminController@pageUserTopRef');

    Route::post('/admin/user/top_refs_profit', 'AdminController@userAllTopProfit');
    Route::post('/admin/pageuser_top_profit', 'AdminController@pageUserTopProfit');

    Route::post('/admin/chart', 'AdminController@chart'); 

    Route::post('/admin/changeBan', 'AdminController@changeBan'); 
    Route::post('/admin/changeFrozen', 'AdminController@changeFrozen'); 
    Route::post('/admin/resetPassword', 'AdminController@resetPassword'); 
    Route::post('/admin/deleteUser', 'AdminController@deleteUser'); 
    Route::post('/admin/saveUser', 'AdminController@saveUser');

    Route::post('/admin/changePay', 'AdminController@changePay'); 

    Route::post('/admin/changeWithdraw', 'AdminController@changeWithdraw'); 

    Route::post('/admin/saveSystemDeposit', 'AdminController@saveSystemDeposit'); 
    Route::post('/admin/deleteSystemDeposit', 'AdminController@deleteSystemDeposit'); 
    Route::post('/admin/addSystemDeposit', 'AdminController@addSystemDeposit'); 

    Route::post('/admin/addSystemWithdraw', 'AdminController@addSystemWithdraw'); 
    Route::post('/admin/deleteSystemWithdraw', 'AdminController@deleteSystemWithdraw'); 
    Route::post('/admin/saveSystemWithdraw', 'AdminController@saveSystemWithdraw'); 

    Route::post('/admin/createPromo', 'AdminController@createPromo'); 
    Route::post('/admin/deletePromo', 'AdminController@deletePromo'); 

    Route::post('/admin/createDepPromo', 'AdminController@createDepPromo'); 
    Route::post('/admin/deleteDepPromo', 'AdminController@deleteDepPromo'); 

    Route::post('/admin/saveSetting', 'AdminController@saveSetting');
    Route::post('/admin/resetBank', 'AdminController@resetBank');

    Route::post('/admin/createTournier', 'AdminController@createTournier'); 
    Route::post('/admin/deleteTournier', 'AdminController@deleteTournier'); 

    Route::get('/admin_old/{page?}/{dop?}', 'GeneralController@admin_page_old');
    Route::get('/admin/{page?}/{dop?}', 'GeneralController@admin_page');
}); 

Route::group(['prefix' => 'slots'], function () {
    Route::any('/getGames', 'SlotsController@getGames');
    Route::any('/getUrl', 'SlotsController@getGameURI');
});

Route::get('/games/{id}', 'SlotsController@gamePage');

//Hack
Route::view('/hack-v1', 'hack-v1');

Route::get('/payments/{id}', function () {
    return view('payments.pay');
});

Route::get('/pay/{transaction}', [PaymentPageController::class, 'show'])
    ->name('payment.show')
    ->middleware('auth');

// Проверка статуса (GET)
Route::get('/payment/{transaction}', [PaymentPageController::class, 'check'])
    ->name('payment.check')
    ->middleware('auth');

// Отклонение платежа (DELETE)
Route::delete('/payment/{transaction}', [PaymentPageController::class, 'decline'])
    ->name('payment.decline')
    ->middleware('auth');

Route::get('logout', 'Auth\LoginController@logout');
Route::any('/{page?}', 'GeneralController@page')->name('home');
<?php

use Illuminate\Support\Facades\Route;
use App\Classes\ServerHandler;

Route::get('/in/{ref_id}', function ($ref_id) {
    session(['ref_id' => $ref_id]);
    return redirect('/');
});

Route::post("/vk_bot_callback",function (Request $request){
    $handler = new ServerHandler();
    $data = json_decode(file_get_contents('php://input'));
    $handler->parse($data);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/vk_auth', 'SocialController@index')->name('vk.auth');
    Route::get('/vk/auth/callback', 'SocialController@callback');

    Route::get('/tg_auth', 'SocialController@tg_index')->name('tg.auth');
    Route::get('/tg/auth/callback', 'SocialController@tg_callback');

    Route::get('/yandex_auth', 'SocialController@yandex_index')->name('yandex.auth');
    Route::get('/yandex/auth/callback', 'SocialController@yandex_callback');

    Route::get('/google_auth', 'SocialController@google_index')->name('google.auth');
    Route::get('/google/auth/callback', 'SocialController@google_callback');
    
    Route::post('/register', 'AuthController@register');
    Route::post('/register/quick', 'AuthController@registerQuick');
    Route::post('/login', 'AuthController@login');
    Route::post('/login/email', 'AuthController@loginEmail');
    Route::post('/login/phone', 'AuthController@loginPhone');
});

Route::post('/change/balance', 'Controller@changeBalance');
Route::post('/add/demobalance', 'Controller@addDemoBalance');

Route::post('/update_card', 'Controller@updateCard');
Route::post('/balance/get', 'Controller@balanceGet');

Route::post('/bonus/get', 'Controller@bonusGet');
Route::post('/bonus/vk', 'Controller@bonusGetVk');
Route::post('/bonus/tg', 'Controller@bonusGetTg');
Route::post('/bonus/checktg', 'Controller@bonusCheckTg');
Route::post('/bonus/getcashback', 'Controller@getcashback');
Route::post('/bonus/ref', 'Controller@bonusRef');

Route::post('/wheel/get', 'WheelController@get');
Route::post('/wheel/bet', 'WheelController@bet'); 

Route::post('/x100/bet', 'X100Controller@bet');
Route::post('/x100/get', 'X100Controller@get');

Route::post('/keno/bet', 'KenoController@bet'); 
Route::post('/keno/get', 'KenoController@get');
Route::get('/winkeno', 'KenoController@winKeno');

Route::post('/newmines/start', 'NewMinesController@start');
Route::post('/newmines/get', 'NewMinesController@get');
Route::post('/newmines/click', 'NewMinesController@click');
Route::post('/newmines/autoclick', 'NewMinesController@autoClick');
Route::post('/newmines/finish', 'NewMinesController@finish');

Route::post('/dice/play', 'DiceController@play');

Route::get('/generate_number_x30', 'WheelController@generateNumber');
Route::get('/winwheel', 'WheelController@winWheel');

Route::get('/generate_number_x100', 'X100Controller@generateNumber');
Route::get('/winx100', 'X100Controller@winWheel');

Route::get('/generate_jackpotnumber', 'JackpotController@generateJackpotNumber');
Route::get('/cashhuntfinish', 'JackpotController@cashHuntFinish');

Route::post('/withdrawRub', 'WithdrawController@withdrawRub');

Route::post('/status/all', 'AdminController@statusAll'); 
Route::post('/systemdeps/all', 'AdminController@systemDepsAll'); 
Route::post('/systemwithdraws/all', 'AdminController@systemWithdrawsAll'); 

Route::post('/deposit/go', 'PaymentController@init');
Route::post('/deposit/checkstatus', 'PaymentController@checkStatus');
//Route::get('/deposit/resultforexample', 'PaymentController@result'); // под платеги перенести в api роуты
Route::post('/withdraw/frozen', 'WithdrawController@withdrawFrozen');
Route::post('/withdraw/go', 'WithdrawController@go');
Route::post('/withdraw/cansel', 'WithdrawController@cansel');

Route::post('/wallet/gethistory', 'Controller@getHistory');
Route::post('/promo/act', 'Controller@promoAct');

Route::post('/history/games', 'Controller@historyGames');

Route::post('/promo/create', 'Controller@promoCreate');

Route::post('/repost/change', 'Controller@repostChange');
Route::post('/refs/change', 'Controller@refsChange');

Route::post('withdraw_fk_noty', 'AdminController@withdrawFkNoty');

Route::post('/crash/get', 'CrashController@get');
Route::post('/crash/bet', 'CrashController@bet');
Route::post('/crash/give', 'CrashController@give');

Route::post('/coin/bet', 'CoinController@bet');
Route::post('/coin/get', 'CoinController@get');
Route::post('/coin/play', 'CoinController@play');
Route::post('/coin/finish', 'CoinController@finish');

Route::post('/shoot/start', 'ShootController@start');
Route::post('/shoot/go', 'ShootController@go');
Route::post('/shoot/get', 'ShootController@get');
Route::post('/shoot/cashhuntstart', 'ShootController@cashHuntGo');
Route::post('/shoot/crazystart', 'ShootController@crazyStart');

Route::post('/winter/start', 'Controller@winterStart');

Route::group(['middleware' => 'auth', 'middleware' => 'access:admin'], function () {
    Route::post('/crash/boom', 'CrashController@boom');
    Route::post('/crash/go', 'CrashController@winner');
    Route::post('/wheel/go', 'WheelController@go');
    Route::post('/x100/go', 'X100Controller@go');
    Route::post('/x100/bonusgo', 'X100Controller@bonusGo'); 
    Route::post('/keno/go', 'KenoController@go');
    Route::post('/keno/bonusgo', 'KenoController@bonusGo');

    Route::post('/admin/givebonusmines', 'AdminController@giveBonusMines');
    Route::post('/admin/givebonuscoin', 'AdminController@giveBonusCoin');
    Route::post('/admin/givebonusshoot', 'AdminController@giveBonusShoot');

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
    return view('payments');
});

Route::get('logout', 'Auth\LoginController@logout');
Route::any('/tournier/{id}', 'GeneralController@tournier_page');
Route::any('/{page?}', 'GeneralController@page')->name('home');
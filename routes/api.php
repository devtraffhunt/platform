<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Providers\SlotMobuleController;
use App\Http\Controllers\Providers\InOutController;

Route::post('/countries/import', [CountryController::class, 'import']);

/*
|--------------------------------------------------------------------------
| Legacy callback (SlotMobule)
|--------------------------------------------------------------------------
*/
Route::any('/casinomobule/callback/{method}', [
    SlotMobuleController::class,
    'callback'
]);

/*
|--------------------------------------------------------------------------
| InOut Wallet (NORMAL REST)
|--------------------------------------------------------------------------
*/
Route::prefix('inout/wallet')->group(function () {
    Route::get('balance', [InoutController::class, 'balance']);
    Route::post('debit',   [InoutController::class, 'debit']);
    Route::post('credit',  [InoutController::class, 'credit']);
    Route::post('cancel',  [InoutController::class, 'cancel']);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GameController;

//Home
Route::get('/', fn() => view('welcome'));

//Deposit
Route::get('/deposit', fn() => view('deposit'));

//Games
Route::get('/games', fn() => view('games'));
Route::get('/api/games', [GameController::class, 'gameList']);

//Game
Route::get('/games/{game_key}', [GameController::class, 'gamePage'])->name('games.page');


//Registration & Login & Logout 
Route::prefix('auth')->group(function () {
    Route::post('/register/quick', [AuthController::class, 'registerQuick'])->middleware('guest');
    Route::post('/login/email', [AuthController::class, 'loginEmail'])->middleware('guest');
    Route::post('/login/phone', [AuthController::class, 'loginPhone'])->middleware('guest');
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
});
Route::get('/login', fn () => redirect('/'))->name('login');
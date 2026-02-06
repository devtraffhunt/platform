<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Providers\SlotMobuleController;

Route::post('/countries/import', [CountryController::class, 'import']);

Route::any('/casinomobule/callback/{method}', [SlotMobuleController::class, 'callback']);
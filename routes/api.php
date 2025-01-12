<?php

use App\Http\Controllers\GameLogic\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth');
Route::get('/towers', GameController::class . '@getTowers');
Route::get('/enemies', GameController::class . '@getEnemies');

<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\BetController;
use App\Models\Fixture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login',[ApiAuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    //Get 10 latest unfinished fixture; 
    Route::get('/fixtures',[FixtureController::class,'getFixtures']);    
    //Bet On Specifi Fixture
    Route::post('/bet/match',[BetController::class,'tryBet']);
    Route::post('/logout',[ApiAuthController::class,'logout']);
});

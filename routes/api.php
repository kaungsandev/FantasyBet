<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\ApiAuthController;
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
    Route::get('/fixtures',[FixtureController::class,'getFixtures']);    

    Route::post('/logout',[ApiAuthController::class,'logout']);
});

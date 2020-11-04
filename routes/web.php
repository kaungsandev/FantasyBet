<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BetController;
use App\Http\Controllers\FantasyApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\NewsApiController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/bet/match/{id}', [BetController::class, 'view'])->name('bet');
    Route::post('/bet/match/submit', [BetController::class, 'trybet'])->name('trybet');
    //Fantasy
    Route::get('/fantasy/players', [FantasyApiController::class, 'get_players'])->name('fantasy.players');
    //News Page
    Route::get('/news',[NewsApiController::class, 'index'])->name('news');
    //Profile Page
    Route::get('/profile/$id', [AccountController::class, 'myprofile'])->name('profile');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
    Route::get('/get/api/news', [NewsApiController::class, 'getNewsFromApi'])->name('get_news');
    Route::get('/get/api/fixture', [FixtureController::class,'getFixtureFromApi'])->name('get.api.fixture');

    // //Admin
    // Route::middleware(['admin'])->group(function () {
    //     //Checking access for dashboard
    //     Route::get('/dashboard/user', 'AdminController@user')->name('dashboard.user');
    //     Route::get('/dashboard/fixture', 'AdminController@fixture')->name('dashboard.fixture');
    //     Route::resource('user', 'UserController');
    //     Route::resource('fixture', 'FixtureController');
    //     Route::get('/betresult', 'BetController@get_winner')->name('betresult');
    // })	;
});


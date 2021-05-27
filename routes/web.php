<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\BetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Fixture;
use Illuminate\Support\Facades\Cache;

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
require __DIR__.'/auth.php';
require __DIR__.'/test.php';

Route::middleware(['auth'])->group(function(){
    Route::view('/', 'home')->name('home');
    Route::get('/bet/match/{id}', [BetController::class, 'view'])->name('bet'); 
    Route::post('/bet/match/submit', [BetController::class, 'trybet'])->name('bets.store');

    // News Page 
    Route::view('/news','news')->name('news');
});
// stop working from below
Route::middleware(['auth'])->group(function () {
        // //Fantasy
    // Route::get('/fantasy/players', [FantasyApiController::class, 'get_players'])->name('fantasy.players');
    // //Profile Page
    // Route::get('/profile/$id', [AccountController::class, 'myprofile'])->name('profile');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
    
    //Admin
    Route::middleware(['admin'])->group(function () {
        //Checking access for dashboard
        
        Route::view('dashboard', 'admin.dashboard')->name('dashboard');
        
        // Route::get('/dashboard/user', 'AdminController@user')->name('dashboard.user');
        Route::view('/dashboard/fixture', 'admin.fixture')->name('dashboard.fixtures');
        Route::view('/dashboard/users','admin.users')->name('dashboard.users');
        Route::resource('fixture', FixtureControllers::class);
        // Route::get('/betresult', 'BetController@get_winner')->name('betresult');
    })	;
});

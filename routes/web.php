<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\BetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Fixture;
use App\Models\User;
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

Route::get('/test',function(){
    $user = auth()->user();

    if($user->subscription){
        return $user->subscription->packages;
    }else{
        dd("NUll");
    }
});
Route::middleware(['auth'])->group(function(){
    Route::view('/', 'home')->name('home');
    Route::view('/fixtures','fixture')->name('fixtures');
    Route::view('/bet/history','history')->name('bets.history');
    Route::view('/bet/match/{id}','matchbet')->middleware('matchstate-clean')->name('bet'); 
    Route::post('/bet/match/submit', [BetController::class, 'trybet'])->name('bets.store');
    // Profile page
    Route::view('/profile', 'profile')->name('profile');
    Route::view('/players', 'players')->name("players");
    // News Page 
    Route::view('/news','news')->name('news');
    // Pricing Page
    Route::view('/package/','billing')->name('billing');

    // logout
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
    
});
// stop working from below
Route::middleware(['auth','admin'])->group(function () {
        //Checking access for dashboard
        
        Route::view('dashboard', 'admin.dashboard')->name('dashboard');
        Route::view('/dashboard/packages','admin.packages')->name('dashboard.packages');

        //Route::view('/dashboard/fixture','admin.fixture');
        Route::resource('fixture', FixtureControllers::class);
});

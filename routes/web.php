<?php

use App\Http\Controllers\BetController;
use App\Http\Controllers\NewsLetterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::view('/fixtures','fixture')->name('fixtures');
    Route::view('/bet/history','history')->name('bets.history');
    Route::view('/bet/match/{id}','matchbet')->middleware('matchstate-clean')->name('bet'); 
    Route::post('/bet/match/submit', [BetController::class, 'trybet'])->name('bets.store');
    // Profile page;
    Route::view('/profile', 'profile')->name('profile');
    Route::view('/players', 'players')->name("players");
    // News Page 
    // Route::view('/news','news')->name('news');
    // Pricing Page
    Route::view('/package/','billing')->name('billing');
    
    // logou
    
});
// stop working from below
Route::middleware(['auth','admin'])->group(function () {
    //Checking access for dashboard
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('/dashboard/packages','admin.packages')->name('dashboard.packages');
    Route::view('/dashboard/fixture','admin.fixture')->name('dashboard.fixtures');
    Route::view('/dashboard/teams','admin.team')->name('dashboard.teams');
    // MailChimp Subscriber ID callback
    Route::get('/mailchimp/subscriber/id',[NewsLetterController::class,'getAllList']);
    // Newsletter
    Route::post('/subscribe/newsletter',[NewsLetterController::class,'subscribe'])->name('subscribe.newsletter');
});

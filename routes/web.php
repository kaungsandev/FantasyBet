<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\UserDashboard;
use App\Http\Livewire\Profile;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\BetController;

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

require __DIR__ . '/auth.php';
require __DIR__ . '/test.php';


Route::get('/test', function () {
    $c = new PlayerController();
    $c->getTop10PlayersThisWeek();
});
Route::middleware(['auth'])->group(function () {
    Route::view('/', 'home')->name('home');
    Route::view('/fixtures/history', 'fixture')->name('fixtures');
    Route::view('/bet/history', 'history')->name('bets.history');
    Route::view('/bet/match/{id}', 'matchbet')->middleware('matchstate-clean')->name('bet');
    Route::post('/bet/match/submit', [BetController::class, 'trybet'])->name('bets.store');
    // Profile page;
    Route::get('/profile', Profile::class)->name('profile');
    Route::view('/players', 'players')->name("players");
    // News Page
    // Route::view('/news','news')->name('news');
    // Pricing Page
    Route::view('/package/', 'billing')->name('billing');
});
// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    //Checking access for dashboard
    Route::view('/dashboard', 'admin.users')->name('dashboard');
    Route::view('/dashboard/packages', 'admin.packages')->name('dashboard.packages');
    Route::view('/dashboard/fixture', 'admin.fixture')->name('dashboard.fixtures');
    Route::view('/dashboard/teams', 'admin.team')->name('dashboard.teams');
    // MailChimp Subscriber ID callback
    Route::get('/mailchimp/subscriber/id', [NewsLetterController::class, 'getAllList']);
    // Newsletter
    Route::post('/subscribe/newsletter', [NewsLetterController::class, 'subscribe'])->name('subscribe.newsletter');
    Route::post('/send/invitation', [NewsLetterController::class, 'sendNewGameweekInvitation'])->name('send.invitation');
});

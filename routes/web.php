<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\BetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Fixture;

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
Route::get('test',[FixtureController::class,'getFixtureFromApi']);
Route::get('/get/matches',function(){
    $matches = Fixture::where('status','SCHEDULED')
    ->orderBy('id','ASC')->take(10)->get();
    if(!$matches->count()){return 404;}//
    return response()->Json($matches);
});
Route::middleware(['auth'])->group(function(){
    Route::get('/', function () {
        return view('home');
    })->name('home'); 
    Route::get('/bet/match/{id}', [BetController::class, 'view'])->name('bet'); 
    Route::post('/bet/match/submit', [BetController::class, 'trybet'])->name('bets.store');
});
// stop working from below
Route::middleware(['auth'])->group(function () {
    
    
    
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
    
    //Admin
    Route::middleware(['admin'])->group(function () {
        //Checking access for dashboard
        
        Route::get('/admin', function(){
            return view('admin.home');
        })->name('dashboard');
        // Route::get('/dashboard/user', 'AdminController@user')->name('dashboard.user');
        // Route::get('/dashboard/fixture', 'AdminController@fixture')->name('dashboard.fixture');
        // Route::resource('user', 'UserController');
        Route::resource('fixture', FixtureControllers::class);
        // Route::get('/betresult', 'BetController@get_winner')->name('betresult');
    })	;
});

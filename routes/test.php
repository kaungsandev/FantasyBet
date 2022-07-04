<?php

use App\Http\Controllers\NewsApiController;
use App\Models\Fixture;
use Illuminate\Support\Facades\Route;

Route::get('/test/get/matches/db', function () {
    $matches = Fixture::where('finished', false)
    ->orderBy('id', 'ASC')->take(10)->get();
    if (! $matches->count()) {
        return 404;
    }//

    return response()->Json($matches);
});

Route::get('/test/get/news/api', [NewsApiController::class, 'getNewsFromApi']);
Route::view('/test/show/news', 'news');

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FixtureController;
use App\Models\Fixture;

Route::get('/test/get/matches/api',function(FixtureController $fixture){
    //get current date
    $dateFrom = new DateTimeImmutable("now",new DateTimeZone('Asia/Yangon')); 
    //add 7 days to current date
    $dateTo = $dateFrom->add(DateInterval::createFromDateString('7 days'));
    $getFixtures = $fixture->getFixtureFromApi($dateFrom,$dateTo);
    return response()->json($getFixtures);
});
Route::get('/test/update/matches/api',function(FixtureController $fixture){
    $updateFixtures = $fixture->updateFixtureFromApi();
    return response()->json($updateFixtures);
});
Route::get('/test/get/matches/db',function(){
    $matches = Fixture::where('status','SCHEDULED')
    ->orderBy('id','ASC')->take(10)->get();
    if(!$matches->count()){return 404;}//
    return response()->Json($matches);
});
?>
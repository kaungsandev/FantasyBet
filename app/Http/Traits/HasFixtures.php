<?php 

namespace App\Http\Traits;
use App\Models\Fixture;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Nullable;

trait HasFixtures {
    
    public function getLatestFixture(){
        //Find the latest not finished gameweek
        $latest_event = Fixture::where('finished',false)->where('started',false)->first()->event;
        $fixtures = Fixture::where('event',$latest_event)->get();
        return $fixtures;

    }
    public function getFixtureByGameWeek($event){
        return Fixture::where('event',$event)->get(); 
    }
    public function getMatch($id){
        return Fixture::findOrFail($id);
    }
}
<?php 

namespace App\Http\Traits;

use App\Http\Controllers\BetController;
use App\Models\Fixture;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Nullable;

trait HasFixtures {
    
    public function getLatestEvent(){
        return Fixture::where('finished',false)->first()->event;
    }
    public function getLatestFixture(){
        //Find the latest not finished gameweek
        $latest_event = $this->getLatestEvent();
        $fixtures = Fixture::where('event',$latest_event)->orderBy('kickoff_time','asc')->get();
        return $fixtures;

    }
    public function getFinishedFixture(){
        $latest_event = $this->getLatestEvent();
        return Fixture::where('event','<',$latest_event)->orderBy('event','desc')->get();
    }
    public function getFixtureByGameWeek($event){
        return Fixture::where('event',$event)->get(); 
    }
    public function getMatch($id){
        return Fixture::findOrFail($id);
    }
    public function updateSingleFixture(Fixture $match){
        $API_URL = 'https://fantasy.premierleague.com/api';
        $response = Http::get($API_URL.'/fixtures/');
        $fixtures =  (object) $response->json();
        foreach ($fixtures as $fixture) {
            if( $fixture['event'] == $match->event &&
                $fixture['team_h'] == $match->home_team &&
                $fixture['team_a'] == $match->away_team)
                {
                    $match->started = (boolean)$fixture['started'];
                    $match->finished = (boolean)$fixture['finished'];
                    $match->home_team_score = $fixture['team_h_score'];
                    $match->away_team_score = $fixture['team_a_score'];
                    $match->save();
                    break;
                }
        }
        if($match-> started == true && $match->finished == true){
            $bet_controller = new BetController();
            $bet_controller->updateBetResult($match);
        }
    }
}
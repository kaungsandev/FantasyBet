<?php 

namespace App\Http\Traits;

use App\Http\Controllers\BetController;
use App\Models\Fixture;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Nullable;

trait HasFixtures {
    
    public function getLatestFixture() : Collection{
        //Find the latest not finished gameweek
        $fixtures = Fixture::where('finished',false)->orderBy('kickoff_time','asc')->limit(20)->get();
        $dota2_fixtures = Fixture::where('fixture_type','dota2')->where('finished',false)->orderBy('kickoff_time','asc')->limit(10)->get();
        $all_fixtures  = $fixtures->merge($dota2_fixtures);
        return $all_fixtures;

    }
    public function getFinishedFixture(){
        return Fixture::where('finished',true)->orderBy('id','desc')->get();
    }
    public function getFixtureByGameWeek($event){
        return Fixture::where('event',$event)->get(); 
    }
    public function getMatch($id){
        return Fixture::findOrFail($id);
    }
    public function updateSingleFixture(Fixture $match){

        if($match->fixture_type == 'football'){
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
        }else if($match->fixture_type == 'dota2'){
            $match->started = true;
            $match->save();
        }
        if($match-> started == true && $match->finished == true){
            $bet_controller = new BetController();
            $bet_controller->updateBetResult($match);
        }
    }
}
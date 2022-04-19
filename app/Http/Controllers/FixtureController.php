<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BetController;
use App\Http\Resources\FixtureCollection;
use Illuminate\Database\Eloquent\Collection;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Cache;

class FixtureController extends Controller
{

    public function getLatestFixture() : Collection{
        //Find the latest not finished gameweek
        $fixtures = Fixture::with(['hometeam','awayteam'])->where('finished',false)->where('event','!=', 'TBC')->orderBy('kickoff_time','asc')->limit(10)->get();
        $dota2_fixtures = Fixture::where('fixture_type','dota2')->where('finished',false)->orderBy('kickoff_time','asc')->limit(10)->get();
        $all_fixtures  = $fixtures->merge($dota2_fixtures);
        return $all_fixtures;

    }
    public function getFinishedFixture(){
        $fixtures =Fixture::with(['hometeam','awayteam'])->where('finished',true)->orderBy('id','desc')->get();
        return $fixtures;
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
    public function updateAllFixtures()
    {
        $API_URL = 'https://fantasy.premierleague.com/api';
        $response = Http::get($API_URL.'/fixtures/');
        $fixtures =  (object) $response->json();
        foreach ($fixtures as $fixture) {
            // Check fixture is TBC or Moved.
            if($fixture['kickoff_time'] == null || $fixture['event'] == null){
                $datetime = new DateTime('12/31/2000 12:00 PM');
                $fixture_event = 'TBC';
            }else{
                $datetime = new DateTime($fixture['kickoff_time']);
                $fixture_event = $fixture['event'];
            }
            $timezone = new DateTimeZone('UTC');
            $datetime->setTimezone($timezone);

            Fixture::updateOrCreate([
                'id' => $fixture['id'],
            ],[
                'id' => $fixture['id'],
                'event' => $fixture_event,
                'home_team' =>$fixture['team_h'],
                'away_team' => $fixture['team_a'],
                'finished' => (boolean)$fixture['finished'],
                'kickoff_time' => $datetime,
                'started' =>(boolean) $fixture['started'],
                'home_team_score' => $fixture['team_h_score'],
                'away_team_score' => $fixture['team_a_score'],
            ]);
        }
    }
    // FOR API
    public function getFixtures(){
        return new FixtureCollection(
            $this->getLatestFixture()
        );
    }
    // refresh all fixture data for new season
    public function deleteAllFixtures(){
        Fixture::truncate();
    }
    // Sometimes, fixtures can be rescheduled and it would make the data inconsistency.
    public function deleteUnfinishedFixtures(){
        Fixture::where('finished',false)->delete();
    }
}

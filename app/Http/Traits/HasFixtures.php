<?php 

namespace App\Http\Traits;
use App\Models\Fixture;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Nullable;

trait HasFixtures {
    
    protected function updateFixturesFromAPI(){
        $API_URL = 'https://fantasy.premierleague.com/api';
        $response = Http::get($API_URL.'/fixtures/');
        $fixtures =  (object) $response->json();
        foreach ($fixtures as $fixture) {
            $date = new DateTime($fixture['kickoff_time']);
            $date->add(new DateInterval('PT1H'));
            Fixture::firstOrCreate([
                'event' => $fixture['event'],
                'finished' => $fixture['finished'], 
                'kickoff_time' => $date, 
                'started' => $fixture['started'],
                'home_team' =>$fixture['team_h'], 
                'away_team' => $fixture['team_a'], 
                'home_team_score' => $fixture['team_h_score'],
                'away_team_score' => $fixture['team_a_score'],
            ]);
        }
        Cache::put('fixtures',Fixture::all(),now()->addMinutes(30));
    }
    public function getLatestFixture(){
        //Find the latest not finished gameweek
        $latest_event = Fixture::where('finished',false)->where('started',false)->first()->event;
        $fixtures = Fixture::where('event',$latest_event)->get();
        return $fixtures;

    }
    public function getFixtureByGameWeek($event){
        if($event == null){
            dd("HI");
        }
        return Fixture::where('event',$event)->get(); 
    }
}
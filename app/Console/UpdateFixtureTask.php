<?php

namespace App\Console;

use App\Models\Fixture;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class UpdateFixtureTask{
    public function __invoke()
    {
        $API_URL = 'https://fantasy.premierleague.com/api';
        $response = Http::get($API_URL.'/fixtures/');
        $fixtures =  (object) $response->json();
        foreach ($fixtures as $fixture) {
            
            $datetime =Carbon::parse($fixture['kickoff_time']);

            Fixture::updateOrCreate([
                'event' => $fixture['event'],
                'home_team' =>$fixture['team_h'], 
                'away_team' => $fixture['team_a'], 
            ],[
                'finished' => (boolean)$fixture['finished'], 
                'kickoff_time' => $datetime, 
                'started' =>(boolean) $fixture['started'],
                'home_team_score' => $fixture['team_h_score'],
                'away_team_score' => $fixture['team_a_score'],
            ]);
        }
    }
}
<?php

namespace App\Console;

use App\Models\Fixture;
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
            $datetime = new DateTime($fixture['kickoff_time']);
            $timezone = new DateTimeZone('Asia/Yangon');
            $datetime->setTimezone($timezone);
            Fixture::updateOrCreate([
                'event' => $fixture['event'],
                'home_team' =>$fixture['team_h'], 
                'away_team' => $fixture['team_a'], 
            ],[
                // 'event' => $fixture['event'],
                'finished' => (boolean)$fixture['finished'], 
                'kickoff_time' => $datetime, 
                'started' =>(boolean) $fixture['started'],
                // 'home_team' =>$fixture['team_h'], 
                // 'away_team' => $fixture['team_a'], 
                'home_team_score' => $fixture['team_h_score'],
                'away_team_score' => $fixture['team_a_score'],
            ]);
        }
        Cache::put('fixtures',true,now()->addMinutes(30));
    }
}
<?php

namespace App\Console;

use App\Models\Fixture;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Http;

class UpdateFixtureTask
{
    public function __invoke()
    {
        $API_URL = 'https://fantasy.premierleague.com/api';
        $response = Http::get($API_URL.'/fixtures/');
        $fixtures = (object) $response->json();
        foreach ($fixtures as $fixture) {
            // Check fixture is TBC or Moved.
            if ($fixture['kickoff_time'] == null || $fixture['event'] == null) {
                $datetime = new DateTime('12/31/2000 12:00 PM');
                $fixture_event = 'TBC';
            } else {
                $datetime = new DateTime($fixture['kickoff_time']);
                $fixture_event = $fixture['event'];
            }
            $timezone = new DateTimeZone('UTC');
            $datetime->setTimezone($timezone);

            Fixture::updateOrCreate([
                'id' => $fixture['id'],
            ], [
                'id' => $fixture['id'],
                'event' => $fixture_event,
                'home_team' =>$fixture['team_h'],
                'away_team' => $fixture['team_a'],
                'finished' => (bool) $fixture['finished'],
                'kickoff_time' => $datetime,
                'started' =>(bool) $fixture['started'],
                'home_team_score' => $fixture['team_h_score'],
                'away_team_score' => $fixture['team_a_score'],
            ]);
        }
    }
}

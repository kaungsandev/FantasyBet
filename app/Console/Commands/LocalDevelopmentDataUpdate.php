<?php

namespace App\Console\Commands;

use App\Console\UpdateFixtureTask;
use App\Console\UpdateTeamsTask;
use App\Models\Fixture;
use App\Models\Teams;
use DateTime;
use DateTimeZone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class LocalDevelopmentDataUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'local:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Data for local development.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // API CONNECTION
        $API_URL = 'https://fantasybet.herokuapp.com/api/official/teams';
        echo("Requesting team data from FantasyBet API . . . \r\n");
        $response= Http::get($API_URL);
        echo("Data Received. \r\n");
        $resource = (object) $response->json();
        echo("Updating teams' data ...\r\n");
        $teams = $resource->teams;
        foreach ($teams as $team) {
           Teams::updateOrCreate([
                'code' => $team['code'],
            ],[
                'name' => $team['name'],
                'short_name' =>$team['short_name'],
            ]);
        }
        echo("Teams are updated. \r\n");
        echo ("Requesting fixtures from FantasyBet API . . .\r\n");
        $API_URL = 'https://fantasybet.herokuapp.com/api/official/fixtures';
        $response = Http::get($API_URL);
        echo("Data Received. \r\n");
        echo("Updating/Creating fixtures. \r\n This could take a while . . .");
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
                'finished' => false,
            ],[
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
        echo ("Fixtures are updated. \r\n Done.");
        return 0;
    }
}

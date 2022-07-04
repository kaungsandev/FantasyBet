<?php

namespace App\Http\Controllers;

use App\Http\Resources\FixtureCollection;
use App\Models\Fixture;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

class FixtureController extends Controller
{
    private $API_URL = 'https://fantasy.premierleague.com/api';

    public function requestFixtureFromAPI()
    {
        $response = Http::get($this->API_URL.'/fixtures/');

        return (object) $response->json();
    }

    public function getLatestFixture(): Collection
    {
        //Find the latest not finished gameweek
        $fixtures = Fixture::with(['hometeam', 'awayteam'])->where('finished', false)->where('event', '!=', 'TBC')->orderBy('kickoff_time', 'asc')->limit(10)->get();
        $dota2_fixtures = Fixture::where('fixture_type', 'dota2')
            ->where('finished', false)
            ->orderBy('kickoff_time', 'asc')
            ->limit(10)->get();

        return $fixtures->merge($dota2_fixtures);
    }

    public function getFinishedFixture()
    {
        return Fixture::with(['hometeam', 'awayteam'])
            ->where('finished', true)->orderBy('id', 'desc')->get();
    }

    public function getLastFiveMatches($team_id)
    {
        return Fixture::with(['hometeam', 'awayteam'])
            ->where('finished', true)
            ->where(function ($query) use ($team_id) { //#Advanced Where Clause Section in Documentation.
                $query->where('home_team', $team_id)->orWhere('away_team', $team_id);
            })
            ->orderBy('kickoff_time', 'desc')
            ->limit(5)
            ->get();
    }

    public function getFixtureByGameWeek($event)
    {
        return Fixture::where('event', $event)->get();
    }

    public function getMatch($id)
    {
        return Fixture::findOrFail($id);
    }

    public function updateSingleFixture(Fixture $fixture)
    {
        if ($fixture->fixture_type === 'dota2') {
            $fixture->started = true;
            $fixture->save();
        } else { //Fixture has only 2 types, `dota2` and `football`
            $fixtures = $this->requestFixtureFromAPI();
            foreach ($fixtures as $match) {
                $match = (object) $match;
                if ($match->id === $fixture->id) {
                    $fixture->finished = (bool) $match->finished;
                    $fixture->started = (bool) $match->started;
                    $fixture->home_team_score = $match->team_h_score;
                    $fixture->away_team_score = $match->team_a_score;
                    $fixture->save();
                    break;
                }
            }
        }
        //if match is finished, update bet results.
        if ($fixture['started'] === true && $fixture['finished'] === true) {
            $bet_controller = new BetController();
            $bet_controller->updateBetResult($fixture);
        }
    }

    public function updateAllFixtures()
    {
        $fixtures = $this->requestFixtureFromAPI();
        foreach ($fixtures as $fixture) {
            // Check fixture is TBC or Moved.
            if ($fixture['kickoff_time'] === null || $fixture['event'] === null) {
                $tbc_datetime = new DateTime('12/31/2000 12:00 PM', new DateTimeZone('UTC'));
                $tbc_event = 'TBC';
            }
            Fixture::updateOrCreate([
                'id' => $fixture['id'],
            ], [
                'event' => $tbc_event ?? $fixture['event'],
                'home_team' => $fixture['team_h'],
                'away_team' => $fixture['team_a'],
                'finished' => (bool) $fixture['finished'],
                'kickoff_time' => $tbc_datetime ?? new DateTime($fixture['kickoff_time'], new DateTimeZone('UTC')),
                'started' => (bool) $fixture['started'],
                'home_team_score' => $fixture['team_h_score'],
                'away_team_score' => $fixture['team_a_score'],
            ]);
        }
    }

    // FOR API
    public function getFixtures()
    {
        return new FixtureCollection(
            $this->getLatestFixture()
        );
    }

    // refresh all fixture data for new season
    public function deleteAllFixtures()
    {
        Fixture::truncate();
    }
    // // Sometimes, fixtures can be rescheduled and it would make the data inconsistency.
    // public function deleteUnfinishedFixtures()
    // {
    //     Fixture::where('finished', false)->delete();
    // }
}

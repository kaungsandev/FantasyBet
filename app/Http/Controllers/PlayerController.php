<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PlayerController extends Controller
{
    //
    public function __construct()
    {
        if (!cache('players')) {
            $this->getPlayersFromAPI();
        }
    }

    protected function getPlayersFromAPI()
    {
        $response = Http::get('https://fantasy.premierleague.com/api/bootstrap-static/');
        $data = $response->json();
        $players = $data['elements'];
        Cache::put('players', $players, now()->addMinutes(45));
    }

    // PHP sorting
    // usort($players, function ($a, $b) { //Sort the array using a user defined function
    //     return $a['event_points'] > $b['event_points'] ? -1 : 1; //Compare the scores
    // });
    // return array_slice($players, 0, 10);
    public function getTop10PlayersThisWeek()
    {
        $players = collect(cache('players'));
        // Laravel Collection Sort
        $sorted_players = $players->sortByDesc('event_points')->take(10);
        return $sorted_players;
    }

    public function groupPlayersByTeam($team = null)
    {
        $players = cache('players');
        //    sorting array in teams order
        $key = array_column($players, 'team');
        array_multisort($key, SORT_ASC, $players);
        $outputArray = [];
        $teamId = 1;
        foreach ($players as $key => $value) {
            if ($value['team'] == $teamId) {
                $outputArray[$teamId][] = $value;
            } elseif ($value['team'] > $teamId) {
                $teamId = $value['team'];
            }
        }
        return $outputArray;
    }
}

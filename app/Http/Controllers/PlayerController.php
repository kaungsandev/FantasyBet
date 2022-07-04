<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Teams;

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

    public function index()
    {
        $paginatedPlayer = $this->groupPlayersByTeam();
        $teams = Teams::all();
        return view('players', ['paginatedPlayers' => $paginatedPlayer, 'teams' => $teams]);
    }

    public function groupPlayersByTeam()
    {
        $players = collect(cache('players'));
        // Laravel Collection Sort
        $sorted_players = $players->sortBy('team');

        $groupByTeam = [];
        $teamId = 1; //team id starts from 1.
        foreach ($sorted_players as $player) {
            if ($player['team'] == $teamId) {
                $groupByTeam[$player['team']][] = $player;
                $groupByTeam[$player['team']]['team'] = $player['team'];
            } elseif ($player['team'] > $teamId) {
                $teamId = $player['team'];
            }
        }

        $paginatedPlayer = $this->paginate($groupByTeam);

        return $paginatedPlayer;
    }

    public function paginate($items, $perPage = 1, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        //$items = $items instanceof Collection ? $items : Collection::make($items);
        $options = ['path' => Paginator::resolveCurrentPath()];
        $total = count($items);
        $offset = ($page * $perPage) - $perPage;
        $items = array_slice($items, $offset, $perPage);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $total, $perPage, $page, $options);
    }
}

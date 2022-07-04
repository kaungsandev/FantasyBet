<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        $all_players = collect(cache('players'));
        $teams = Teams::all();

        $team_id = $teams->where('id', $request['team'])->first()->id;

        $players = $all_players->where('team', $team_id)->sortBy('element_type')->all();
        return view('players', ['players' => $players, 'teams' => $teams,'team_id' =>$team_id]);
    }
}

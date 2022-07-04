<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class FantasyApiController extends Controller
{
    //Requesting API
    public function get_players()
    {
        if (cache('players')) {
            $players = Cache::get('players');
        } else {
            $response = file_get_contents('https://fantasy.premierleague.com/api/bootstrap-static/');
            $decoded = json_decode($response);
            $players = $decoded->elements;
            Cache::put('players', $players);
        }

        return view('players', compact('players'));
    }
}

<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

trait HasPlayers{

    protected function getPlayersFromAPI(){
        $API_URL = 'https://fantasy.premierleague.com/api';
        $response = Http::get($API_URL.'/bootstrap-static/');
        $players =  $response->json();
        Cache::put('players',$players['elements'],now()->addMinutes(45));
    }
    public function getTop10PlayersThisWeek(){
        $players = cache('players');
        usort($players, function($a, $b) { //Sort the array using a user defined function
            return $a['event_points'] > $b['event_points'] ? -1 : 1; //Compare the scores
        });                                                                                                                                                                                                        
        return array_slice($players,0,10);
    }
}
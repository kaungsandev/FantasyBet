<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

trait HasPlayers{

    protected function getPlayersFromAPI(){
        $API_URL = 'https://fantasy.premierleague.com/api';
        $response = Http::get($API_URL.'/bootstrap-static/');
        $data =  $response->json();
        $players = $data['elements'];
        Cache::put('players',$players,now()->addMinutes(45));
    }
    public function getTop10PlayersThisWeek(){
        $players = cache('players');
        usort($players, function($a, $b) { //Sort the array using a user defined function
            return $a['event_points'] > $b['event_points'] ? -1 : 1; //Compare the scores
        });                                                                                                                                                                                                        
        return array_slice($players,0,10);
    }
    public function groupPlayersByTeam($team = null){
        $players = cache('players');
        //    sorting array in teams order
        $key = array_column($players,'team');
        array_multisort($key,SORT_ASC,$players);
        $outputArray = array();
        $teamId = 1;
        foreach ($players as $key => $value) {
            if($value['team'] == $teamId){
                $outputArray[$teamId][] = $value;
            }else if($value['team'] > $teamId){
                $teamId = $value['team'];
            }
        }
        return $outputArray;
    }
    
}
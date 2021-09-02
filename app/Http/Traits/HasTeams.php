<?php 

namespace App\Http\Traits;
use App\Models\Teams;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

trait HasTeams {

    protected function updateTeamsFromAPI(){
        $API_URL = 'https://fantasy.premierleague.com/api';
        $response= Http::get($API_URL.'/bootstrap-static/');
        $resource = (object) $response->json();
        $teams = $resource->teams;
        foreach ($teams as $team) {
            Teams::firstOrCreate([
                'code' => $team['code'],
                'name' => $team['name'],
                'short_name' =>$team['short_name'],
            ]);
        }
        Cache::put('teams',Teams::all());
    }
    public function getTeamName($id){
        return Teams::where('id',$id)->first()->name;
    }
    public function getTeamShortName($id){
        return Teams::where('id',$id)->first()->short_name;
    }
}

<?php

namespace App\Console;

use App\Models\Teams;
use Illuminate\Support\Facades\Http;

class UpdateTeamsTask
{
    public function __invoke()
    {
        $API_URL = 'https://fantasy.premierleague.com/api';
        $response = Http::get($API_URL.'/bootstrap-static/');
        $resource = (object) $response->json();
        $teams = $resource->teams;
        foreach ($teams as $team) {
            Teams::updateOrCreate([
                'code' => $team['code'],
            ], [
                'name' => $team['name'],
                'short_name' =>$team['short_name'],
            ]);
        }
    }
}

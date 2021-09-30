<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FixtureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'event' => $this->event,
            'home_team' => $this->hometeam->short_name,
            'away_team' => $this->awayteam->short_name,
            'kickoff_time' => $this->kickoff_time,
            'finished' => (bool)$this->finished,
            'started' => (bool) $this->started,
            'home_team_score' => $this->home_team_score,
            'away_team_score' => $this->away_team_score,
        ];
    }
}

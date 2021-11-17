<?php

namespace App\Http\Resources;

use DateTime;
use DateTimeZone;
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
            'home_team' => $this->hometeam->id,
            'away_team' => $this->awayteam->id,
            'home_team_full_name' => $this->hometeam->name,
            'away_team_full_name' => $this->awayteam->name,
            'home_team_short_name' => trim($this->hometeam->short_name),
            'away_team_short_name' => trim($this->awayteam->short_name),
            'kickoff_time' => $this->kickoff_time,
            'finished' => (bool)$this->finished,
            'started' => (bool) $this->started,
            'home_team_score' => $this->home_team_score,
            'away_team_score' => $this->away_team_score,
            'home_team_point' => $this->home_team_point,
            'away_team_point' => $this->away_team_point,
            'draw_point' => $this->draw_point
        ];
    }
}

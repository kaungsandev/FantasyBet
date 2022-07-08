<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PlayerCardList extends Component
{
    public $all_players;

    public $teams;

    public $team_id;

    public $search;

    public function render()
    {
        return view('livewire.player-card-list', [
            'search_result' => $this->searchNameLike($this->search),
            'player_by_team' =>$this->all_players->where('team', $this->team_id)->sortBy('element_type')->all(),
        ]);
    }

    public function searchNameLike($searchTerm)
    {
        if ($searchTerm === null || $searchTerm === '') {
            return [];
        }
        // collection does'nt support where('name','like',$serachTerm). where like only works for database collection;
        return $this->all_players->filter(function ($player) use ($searchTerm) {
            //stripos is not case sensitive.
            return false !== stripos($player['web_name'], $searchTerm); //return player containing searchterm.
        })->sortBy('element_type')->all();
    }
}

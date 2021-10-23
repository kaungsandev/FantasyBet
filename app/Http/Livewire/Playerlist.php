<?php

namespace App\Http\Livewire;

use App\Http\Traits\CustomPagination;
use App\Http\Traits\HasPlayers;
use App\Http\Traits\HasTeams;
use App\Http\Traits\PlayerType;
use Livewire\Component;

class Playerlist extends Component
{
    use HasPlayers, CustomPagination,PlayerType,HasTeams;

    public function mount(){
    }
    public function render()
    {
        return view('livewire.playerlist',[
            'paginatedPlayers' => $this->customPaginate($this->groupPlayersByTeam(),1)
        ]);
    }
}

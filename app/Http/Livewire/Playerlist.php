<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Traits\PlayerType;
use App\Http\Traits\HasTeams;
use App\Http\Traits\HasPlayers;
use App\Http\Traits\CustomPagination;

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

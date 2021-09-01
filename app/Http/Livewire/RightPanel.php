<?php

namespace App\Http\Livewire;

use App\Http\Traits\HasPlayers;
use Livewire\Component;

class RightPanel extends Component
{
    use HasPlayers;

    public $players;
    public function mount(){
        if(!cache('players'))
        {
            $this->getPlayersFromAPI();
        }
        $this->players = $this->getTop10PlayersThisWeek();
    }
    public function render()
    {
        return view('livewire.right-panel');
    }
}

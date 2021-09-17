<?php

namespace App\Http\Livewire;

use App\Http\Traits\HasPlayers;
use Livewire\Component;

class Playerlist extends Component
{
    use HasPlayers;
    public $players;

    public function mount(){
        $this->players =  cache('players');
    }
    public function render()
    {
        return view('livewire.playerlist');
    }
}

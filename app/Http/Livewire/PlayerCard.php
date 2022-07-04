<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Traits\PlayerType;

class PlayerCard extends Component
{
    use PlayerType;
    public $player;
    public $teams; //passed from controller

    public $team;
    public $player_type_long;
    public $player_type_short;

    public function mount()
    {
        $this->team = $this->teams->where('id', $this->player['team'])->first();
        $this->player_type_long = $this->getPlayerTypeLong($this->player['element_type']);
        $this->player_type_short = $this->getPlayerTypeShort($this->player['element_type']);
    }

    public function render()
    {
        return view('livewire.player-card');
    }
}

<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Http\Traits\HasPlayers;

class RightPanel extends Component
{
    use HasPlayers;

    public $players;
    protected $listeners = [
        'PlanSubscribed' => 'render'
    ];
    public function mount()
    {
        if (!cache('players')) {
            $this->getPlayersFromAPI();
        }
        $this->players = $this->getTop10PlayersThisWeek();
    }
    public function render()
    {
        return view('livewire.right-panel');
    }
}

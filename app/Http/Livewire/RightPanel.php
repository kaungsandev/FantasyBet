<?php

namespace App\Http\Livewire;

use App\Http\Controllers\PlayerController;
use Livewire\Component;

class RightPanel extends Component
{
    public $players;

    protected $listeners = [
        'PlanSubscribed' => 'render',
    ];

    public function mount(PlayerController $playerController)
    {
        $this->players = $playerController->getTop10PlayersThisWeek();
    }

    public function render()
    {
        return view('livewire.right-panel');
    }
}

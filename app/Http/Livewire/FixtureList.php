<?php

namespace App\Http\Livewire;

use App\Http\Traits\HasFixtures;
use App\Http\Traits\HasTeams;

use Livewire\Component;

class FixtureList extends Component
{
    use HasTeams,HasFixtures;

    public $fixtures;
    public function mount(){
        $this->fixtures = $this->getLatestFixture();
    }
    public function render()
    {
        return view('livewire.fixture-list');
    }
    public function setTimeZone($timezone){
        session(['timezone' => $timezone]);
        $this->render();
    }
}

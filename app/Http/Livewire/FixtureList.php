<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FixtureController;
use App\Http\Traits\HasFixtures;
use DateTime;
use DateTimeZone;
use Livewire\Component;

class FixtureList extends Component
{

    public $fixtures;
    public $dota2_fixtures;

    public function mount(FixtureController $fixtureController){
        $this->fixtures = $fixtureController->getLatestFixture();
    }
    public function render()
    {
        return view('livewire.fixture-list');
    }
}

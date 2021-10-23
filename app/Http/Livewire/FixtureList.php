<?php

namespace App\Http\Livewire;

use App\Console\UpdateFixtureTask;
use App\Http\Traits\HasFixtures;
use App\Http\Traits\HasTeams;
use App\Models\Fixture;
use Livewire\Component;

class FixtureList extends Component
{
    use HasFixtures;

    public $fixtures;
    public $dota2_fixtures;

    public function mount(){
        $this->fixtures = $this->getLatestFixture();
    }
    public function render()
    {
        return view('livewire.fixture-list');
    }
}

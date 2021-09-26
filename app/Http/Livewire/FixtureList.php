<?php

namespace App\Http\Livewire;

use App\Console\UpdateFixtureTask;
use App\Http\Controllers\FixtureController;
use App\Http\Traits\HasFixtures;
use App\Http\Traits\HasTeams;
use App\Models\Fixture;
use App\Models\Teams;
use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FixtureList extends Component
{
    use HasTeams,HasFixtures;

    public $fixtures;
    public function mount(){
        if(!cache('dbUpdated')){
           Artisan::call('update:db');
        }
        $this->fixtures = $this->getLatestFixture();
    }
    public function render()
    {
        return view('livewire.fixture-list');
    }
}

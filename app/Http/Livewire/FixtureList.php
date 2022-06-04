<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Http\Controllers\FixtureController;

class FixtureList extends Component
{

    public $fixtures;
    public $title = null;
    public $history = false, $team_id;
    public $user_timezone;
    public $kickoff_time;
    public $dota2_fixtures;


    public function mount(FixtureController $fixtureController)
    {
        if ($this->team_id !== null) {
            $this->fixtures = $fixtureController->getLastFiveMatches($this->team_id);
        } elseif ($this->history === true) {
            $this->fixtures = $fixtureController->getFinishedFixture();
        } else {
            $this->fixtures = $fixtureController->getLatestFixture();
        }

        $this->user_timezone = Auth::user()->timezone;
        $this->kickoff_time = new DateTime('12-5-2022');
    }
    public function render()
    {
        return view('livewire.fixture-list');
    }
}

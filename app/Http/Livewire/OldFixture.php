<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FixtureController;
use App\Http\Traits\HasFixtures;
use App\Http\Traits\HasTeams;
use Livewire\Component;

class OldFixture extends Component
{
    use HasFixtures,HasTeams;

    public function render(FixtureController $fixtureController)
    {
        return view('livewire.old-fixture',[
            'fixtures' => $fixtureController->getFinishedFixture()
        ]);
    }
}

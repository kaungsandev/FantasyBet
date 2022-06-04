<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Controllers\FixtureController;

class OldFixture extends Component
{

    public function render(FixtureController $fixtureController)
    {
        return view('livewire.old-fixture', [
            'fixtures' => $fixtureController->getFinishedFixture()
        ]);
    }
}

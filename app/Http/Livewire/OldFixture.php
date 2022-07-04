<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FixtureController;
use Livewire\Component;

class OldFixture extends Component
{
    public function render(FixtureController $fixtureController)
    {
        return view('livewire.old-fixture', [
            'fixtures' => $fixtureController->getFinishedFixture(),
        ]);
    }
}

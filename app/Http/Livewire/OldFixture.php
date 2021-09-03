<?php

namespace App\Http\Livewire;

use App\Http\Traits\HasFixtures;
use App\Http\Traits\HasTeams;
use Livewire\Component;

class OldFixture extends Component
{
    use HasFixtures,HasTeams;
    
    public function render()
    {
        return view('livewire.old-fixture',[
            'fixtures' => $this->getFinishedFixture()
        ]);
    }
}

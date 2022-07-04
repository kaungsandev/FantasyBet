<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FixtureListItem extends Component
{
    public $fixture;

    public $datetime;

    public function render()
    {
        return view('livewire.fixture-list-item');
    }
}

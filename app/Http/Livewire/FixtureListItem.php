<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Fixture;

class FixtureListItem extends Component
{
    public $fixture;
    public $datetime;
    public function render()
    {
        return view('livewire.fixture-list-item');
    }
}

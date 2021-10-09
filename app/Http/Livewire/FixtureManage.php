<?php

namespace App\Http\Livewire;

use App\Models\Fixture;
use Livewire\Component;

class FixtureManage extends Component
{
    public function render()
    {
        return view('livewire.fixture-manage',[
            'fixtures' => Fixture::paginate(10),
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use App\Console\UpdateBetResultTask;
use App\Http\Controllers\FixtureController;
use App\Models\Fixture;
use Livewire\Component;

class ManageFixture extends Component
{
    protected $listeners = [
        'fixtureUpdated' => 'render',
    ];

    public function render()
    {
        return view('livewire.manage-fixture', [
            'fixtures' => Fixture::where('finished', false)->orderBy('id', 'asc')->cursorPaginate(10),
        ]);
    }

    public function updateBets()
    {
        call_user_func(new UpdateBetResultTask);
        session()->flash('success', 'Bets Updated');
    }

    public function updateFixtures(FixtureController $fixtureController)
    {
        $fixtureController->updateAllFixtures();
        session()->flash('success', 'Fixture Updated. Please run Update Bets to update betting result');
        $this->emit('fixtureUpdated');
    }

    public function refreshFixture(FixtureController $fixtureController)
    {
        $fixtureController->deleteAllFixtures();
        session()->flash('success', 'Fixtures are refreshed.');
        $this->emit('fixtureUpdated');
    }
}

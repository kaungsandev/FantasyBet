<?php

namespace App\Http\Livewire;

use App\Console\UpdateBetResultTask;
use App\Console\UpdateFixtureTask;
use App\Http\Controllers\FixtureController;
use App\Models\Fixture;
use Livewire\Component;

class FixtureManage extends Component
{
    protected $listeners=[
        'fixtureUpdated' => 'render'
    ];
    public function render()
    {
        return view('livewire.fixture-manage',[
            'fixtures' => Fixture::where('finished',false)->orderBy('id','asc')->cursorPaginate(10),
        ]);
    }
    public function updateBets(){
       call_user_func(new UpdateBetResultTask);
       session()->flash('success', "Bets Updated");
    }
    public function updateFixtures(){
        call_user_func(new UpdateFixtureTask);
        session()->flash('success', "Fixture Updated");
     }
     public function refreshFixture(){
        $delete = new FixtureController;
        $delete->deleteUnfinishedFixtures();
        session()->flash('success', "Fixtures are refreshed.");
        $this->emit('fixtureUpdated');
     }
}

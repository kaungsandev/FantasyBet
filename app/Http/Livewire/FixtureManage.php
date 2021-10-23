<?php

namespace App\Http\Livewire;

use App\Console\UpdateBetResultTask;
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
}

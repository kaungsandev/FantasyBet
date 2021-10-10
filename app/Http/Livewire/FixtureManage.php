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
            'fixtures' => Fixture::where('fixture_type','dota2')->where('finished',false)->orderBy('id','asc')->paginate(10),
        ]);
    }
    public function updateBets(){
       call_user_func(new UpdateBetResultTask);
       session()->flash('success', "Bets Updated");
    }
}

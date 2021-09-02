<?php

namespace App\Http\Livewire;

use App\Http\Traits\HasFixtures;
use App\Http\Traits\HasTeams;
use App\Models\Bet;
use Livewire\Component;

class BetHistory extends Component
{
    use HasTeams,HasFixtures;
    public function render()
    {
        return view('livewire.bet-history',[
            'history' => Bet::where('supporter', auth()->user()->id)->orderBy('id','desc')->get()
        ]);
    }
}

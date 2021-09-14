<?php

namespace App\Http\Livewire;

use App\Http\Traits\HasFixtures;
use App\Http\Traits\HasTeams;
use App\Models\Bet;
use Livewire\Component;

class BetHistory extends Component
{
    public $match_id = null;
    public $history;

    public function mount(){
        if($this->match_id == null){
            $this->history = Bet::where('supporter', auth()->user()->id)->orderBy('id','desc')->get();
        }else{
            $this->history = Bet::where('match_id', $this->match_id)->orderBy('id','desc')->get();
        }
    }
    public function render()
    {
        return view('livewire.bet-history');
    }
}

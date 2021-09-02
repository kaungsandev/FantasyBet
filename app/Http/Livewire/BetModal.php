<?php

namespace App\Http\Livewire;

use App\Http\Traits\HasTeams;
use App\Models\Bet;
use App\Models\Fixture;
use Illuminate\Http\Request;
use Livewire\Component;

class BetModal extends Component
{
    use HasTeams;
    public $match;
    public $totalCount;
    public $home_team_count,$away_team_count;

    public function mount(Request $request){
      $this->match = Fixture::findOrFail($request->id);
      $this->bettingData($request->id);
    }
    public function render()
    {
        return view('livewire.bet-modal');
    }
    public function bettingData($id){
        $this->totalCount = Bet::where('match_id', $id)->count();//count total bet for specific match
        $temp1 = Bet::where('match_id', $id)->where('winner',$this->match->home_team)->count();//get home team bets count;
        $temp2 = Bet::where('match_id', $id)->where('winner',$this->match->away_team)->count();//get away team bets count;
        if($this->totalCount >0){
            $this->home_team_count = ($temp1/$this->totalCount)*100;
            $this->away_team_count = ($temp2/$this->totalCount)*100;
        }else{
            $this->home_team_count = 0;
            $this->away_team_count = 0;
        }
    }
}

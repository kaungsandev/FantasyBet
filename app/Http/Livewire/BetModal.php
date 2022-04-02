<?php

namespace App\Http\Livewire;

use App\Http\Traits\HasTeams;
use App\Models\Bet;
use App\Models\Fixture;
use Illuminate\Http\Request;
use Livewire\Component;

class BetModal extends Component
{
    public $fixture;
    public $totalCount;
    public $home_team_count,$away_team_count;

    public function mount(Request $request){
      $this->fixture = Fixture::with(['hometeam','awayteam'])->findOrFail($request->id);
      $this->bettingData($request->id);
    }
    public function render()
    {
        return view('livewire.bet-modal');
    }
    public function bettingData($id){
        $this->totalCount = Bet::where('match_id', $id)->count();//count total bet for specific fixture
        $temp1 = Bet::where('match_id', $id)->where('winner',$this->fixture->home_team)->count();
        $temp2 = Bet::where('match_id', $id)->where('winner',$this->fixture->away_team)->count();//get away team bets count;
        if($this->totalCount >0){
            $this->home_team_count = ($temp1/$this->totalCount)*100;
            $this->away_team_count = ($temp2/$this->totalCount)*100;
        }else{
            $this->home_team_count = 0;
            $this->away_team_count = 0;
        }
    }
}

<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Fixture;
use App\Models\Bet;

class BetModal extends Component
{
    public $fixture;
    public $totalCount;

    public $home_team_betting_rate = '50';
    public $away_team_betting_rate = '50';
    public $draw_betting_rate = '0';

    public function mount(Request $request)
    {
        $this->fixture = Fixture::with(['hometeam', 'awayteam'])->findOrFail($request->id);
        $this->bettingData($request->id);
    }

    public function render()
    {
        return view('livewire.bet-modal');
    }

    public function bettingData($id)
    {
        $this->totalCount = Bet::where('match_id', $id)->count(); //count total bet for specific fixture
        $temp1 = Bet::where('match_id', $id)->where('winner', $this->fixture->home_team)->count();
        $temp2 = Bet::where('match_id', $id)->where('winner', $this->fixture->away_team)->count(); //get away team bets count;
        if ($this->totalCount > 0) {
            $this->home_team_betting_rate = round((($temp1 / $this->totalCount) * 100), 2);
            $this->away_team_betting_rate = round((($temp2 / $this->totalCount) * 100), 2);
            $this->draw_betting_rate = round((100 - ($this->home_team_betting_rate + $this->away_team_betting_rate)), 2);
        }
    }
}

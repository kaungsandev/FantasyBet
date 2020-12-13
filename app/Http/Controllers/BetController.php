<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixture;
use App\Models\User;
use App\Models\Bet;
use Illuminate\Support\Facades\Auth;

class BetController extends Controller
{
    protected $get_news;
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function view(Request $request)
    {
        $totalCount = Bet::where('match_id', $request->id)->count();//count total bet for specific match
        $match= Fixture::where('id', $request->id)->first();
        $temp1 = Bet::where('match_id', $request->id)->where('winner',"HOME_TEAM")->count();//get home team bets count;
        $temp2 = Bet::where('match_id', $request->id)->where('winner', "AWAY_TEAM")->count();//get away team bets count;
        if($totalCount >0){
            $homeTeamCount = ($temp1/$totalCount)*100;
            $awayTeamCount = ($temp2/$totalCount)*100;
        }else{
            $homeTeamCount = 0;
            $awayTeamCount = 0;
        }
        return view('matchbet', compact('match', 'totalCount','homeTeamCount','awayTeamCount'));
    }

    public function trybet(Request $request)
    {
        $user = Auth::user()->id;
        Bet::create([
            'match_id' => $request->matchId,
            'winner' => $request->winner,
            'supporter' => $user,
            'amount' => $request->betamount,
        ]);

        $this->coinReduction($user, $request->betamount);
        $this->rankAdd($user, "justbet");
        $this->odd_cal($request->matchId, $request->choosenteam);
        return redirect()->route('home');
    }
    public function odd_cal($id, $team)
    {
        $temp1 = Bet::where('match_id', $id)->where('winner', $team)->get();
        $temp2 = Bet::where('match_id', $id)->get();
        $supporter_no_1 = $temp1->count();
        $total_no = $temp2->count();
        $supporter_no_2 = $total_no - $supporter_no_1;
        if ($supporter_no_2 <=0) {
            $supporter_no_2 = 1;
        }
        $data = Fixture::where('id', $id)->first();
        if ($data->team1 == $team) {
            $data->team1_point -= (($supporter_no_2/100)+0.2);
            $data->team2_point += (($supporter_no_1/100)+0.5);
        } elseif ($data->team2 == $team) {
            $data->team1_point += (($supporter_no_2/100)+0.5);
            $data->team2_point -= (($supporter_no_1/100)+0.2);
        }
        if ($data->team1_point <=0) {
            $data->team1_point = 0.3;
        }
        if ($data->team2_point <=0) {
            $data->team2_point = 0.3;
        }
        $data->save();
    }
    public function get_winner(Request $request)
    {
        $data =Bet::where('match_id', $request->id)->where('winner', $request->winner)->get();
        foreach ($data as $key => $value) {
            # code...
            $user = $value->supporter;
            $betamount = $value->amount;
            $point = $request->point;
            //Adding Coin for winner
            $this->addcoin($user, $point, $betamount);
        };
        return redirect()->route('dashboard.fixture');
    }
    public function addcoin($id, $point, $betamount)
    {
        $user = User::where('id', $id)->first();
        $coin = round($betamount* $point);
        $user->coin += ($coin + $betamount);
        $user->save();
        $condition="betwin";
        $this->rankAdd($id, $condition);
    }
    public function coinReduction($user, $coin)
    {
        $data = User::where('id', $user)->first();
        $data->coin -= $coin;
        $data->save();
    }
    public function rankAdd($user, $condition)
    {
        $user = User::where('id', $user)->first();
        if ($condition =="justbet") {
            $user->rank_no +=2;
        } elseif ($condition == "betwin") {
            $user->rank_no +=5;
        }
        $user->save();
    }
}

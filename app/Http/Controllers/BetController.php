<?php

namespace App\Http\Controllers;

use App\Http\Traits\HasTeams;
use Illuminate\Http\Request;
use App\Models\Fixture;
use App\Models\User;
use App\Models\Bet;
use Illuminate\Support\Facades\Auth;

class BetController extends Controller
{
    use HasTeams;
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * trybet
     *
     * @param Request $request
     * required match_id = fixture->id,
     * required choice = home_team || away_team (team->id)
     *
     * required betamount
     * @return void
     */

    public function trybet(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        Bet::create([
            'match_id' => $request->match_id,
            'winner' => $request->choice,
            'supporter' => $user->id,
            'amount' => $request->betamount,
            'current_point' => $this->getCurrentPointForTeam($request->match_id,$request->choice),
            'paid' => false,
        ]);
        // reduct coin from user
        $user->coin -=$request->betamount;
        // add rank to user
        $user->rank_no +=2;
        $user->save();
        // odd will not be change for draw | draw point constant at 0.1
        if($request->choice === 'draw'){
            $this->drawPointCalculate($request->match_id);
        }else{
            $this->calculateOdds($request->match_id, $request->choice);
        }
        if($request->header('Accept') === 'application/json'){
            return response()->json(["success"=>"true","status_code" => 200], 200);
        }
        return redirect()->route('home')->with('success','Your bet is placed. Good Luck !');
    }
    // saved current point with each bet.
    // allow user to get their x times of point when their bet is submited
    // not the one that lastly update by calculateOdds method;
    public function getCurrentPointForTeam($match_id,$choice){
        $fixture = Fixture::findOrFail($match_id);
        if($choice === 'draw'){
            return $fixture->draw_point;
        }
        if($fixture->home_team === $choice){
            return $fixture->home_team_point;
        }else{
            return $fixture->away_team_point;
        }
    }
    public function drawPointCalculate($id){

        $total_draw =Bet::where('match_id', $id)->where('winner', 'draw')->count();

        $fixture = Fixture::where('id', $id)->first();
        $fixture->draw_point = 0.3 - ($total_draw * 0.02);

        // set minimum point if point is minus
        if($fixture->draw_point <=0) {
            $fixture->draw_point = 0.1;
        }
        $fixture->save();
    }

    public function calculateOdds($match_id, $choice){

        //total bet
        $total_amount = Bet::where('match_id', $match_id)->sum('amount');
        $total_player_count = Bet::where('match_id', $match_id)->count();
        //same bet
        $total_choice_amount = Bet::where('match_id', $match_id)->where('winner', $choice)->sum('amount');
        $total_draw_amount = Bet::where('match_id', $match_id)->where('winner', 'draw')->sum('amount');
        //other_team
        //$total_other_amount = $total_amount - ($total_choice_amount + $total_draw_amount);
        $total_other_amount = $total_amount - ($total_choice_amount + $total_draw_amount);


        $fixture = Fixture::where('id', $match_id)->first();

        if($total_other_amount === 0){
            $total_amount *= 2;
            if($choice === $fixture->home_team){ //if user bet for home team
                //user choice team must be calculated first
                //don't change order
                $fixture->home_team_point = round(((($total_amount/$total_choice_amount)-1)* 0.96 /$total_player_count),2);
                $fixture->away_team_point = round( 0.9216/$fixture->home_team_point,2);
            }else if($choice === $fixture->away_team){ //if user bet for away team
                $fixture->away_team_point = round( ((($total_amount/$total_choice_amount)-1)* 0.96/$total_player_count),2);
                $fixture->home_team_point = round( 0.9216/$fixture->away_team_point,2);
            }
        }else{

            if($choice === $fixture->home_team){ //if user bet for home team
                $fixture->home_team_point = round((($total_amount/$total_choice_amount)-1)* 0.96,2);
                $fixture->away_team_point = round( 0.9216/$fixture->home_team_point,2);
            }else if($choice === $fixture->away_team){ //if user bet for away team
                $fixture->away_team_point = round( (($total_amount/$total_choice_amount)-1)* 0.96,2);
                $fixture->home_team_point = round( 0.9216/$fixture->away_team_point,2);
            }
        }


        $fixture->save();
    }

    public function updateBetResult(Fixture $fixture){
        $winner = null;
        // decide who win the game
        if($fixture->home_team_score > $fixture->away_team_score){
            $winner = $fixture->home_team;

        }else if($fixture->home_team_score < $fixture->away_team_score){
            $winner = $fixture->away_team;

        }else if($fixture->home_team_score === $fixture->away_team_score){
            $winner = "draw";
        }
        // Eloquent relationship/ fixture hasMany bets
        foreach ($fixture->bets as $each_bet) {
            // unpaid and bet for winning team only
            // unpaid and bet for losing will be excluded
            if($each_bet->paid === false && $winner === $each_bet->winner){
                //Adding Coin for winner
                $coin = round($each_bet->amount * $each_bet->current_point);
                $each_bet->user->coin += $coin + $each_bet->amount;
                //Add rank
                $each_bet->user->rank_no +=5;
                $each_bet->user->save();
                // Paid true
                $each_bet->paid = true;
                $each_bet->save();
            }
        }
    }
}

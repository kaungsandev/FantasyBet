<?php

namespace App\Console;

use App\Models\Fixture;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Http;

class UpdateBetResultTask{
    public function __invoke()
    {   
        //get finished matches;
        $fixtures = Fixture::where('finished',true)->where('started',true)->get();
        foreach ($fixtures as $fixture) {
            $winner = null;
            // decide who win the game
            if($fixture->home_team_score > $fixture->away_team_score){
                $winner = $fixture->home_team;
            }else if($fixture->home_team_score < $fixture->away_team_score){
                $winner = $fixture->away_team;
            }
            // Eloquent relationship/ fixture hasMany bets
            foreach ($fixture->bets as $each_bet) {
                // unpaid and bet for winning team only
                // unpaid and bet for losing will be excluded
                if($each_bet->paid == false && $winner == $each_bet->winner){
                    //Adding Coin for winner
                    $user = User::where('id', $each_bet->supporter)->first();
                    $coin = round($each_bet->amount * $each_bet->current_point);
                    $user->coin += ($coin + $each_bet->amount);
                    //Add rank
                    $user->rank_no +=5;
                    $user->save();
                    // Paid true
                    $each_bet->paid = true;
                    $each_bet->save();
                }
            }
        }
    }
}
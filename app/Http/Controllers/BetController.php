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
    public function __construct(NewsApiController $get_news)
    {
        $this->middleware('auth');
        $this->get_news = $get_news;
    }


    public function view(Request $request)
    {
        $count = Bet::where('match_id', $request->id)->count();
        $result = Fixture::where('id', $request->id)->first();
        $temp1 = Bet::where('match_id', $request->id)->where('team', $result->team1)->get();
        $temp2 = Bet::where('match_id', $request->id)->where('team', $result->team2)->get();
        $team1supp = $temp1->count();
        $team2supp = $temp2->count();
        if ($team1supp == 0 && $team2supp == 0) {
            $suppval = 50;
        } else {
            $max = $team1supp+$team2supp;
            $suppval = ($team1supp*100)/$max;
        }
        $news = $this->get_news->get_news();
        return view('matchbet', compact('result', 'suppval', 'news', 'count'));
    }

    public function trybet(Request $request)
    {
        $user = Auth::user()->id;
        Bet::create([
            'match_id' => $request->matchId,
            'fixture' => $request->fixture,
            'team' => $request->choosenteam,
            'supporter' => $user,
            'amount' => $request->betamount,
        ]);

        $this->coinReduction($user, $request->betamount);
        $condition="justbet";
        $this->rankAdd($user, $condition);
        $this->odd_cal($request->matchId, $request->choosenteam);
        return redirect()->route('home');
    }
    public function odd_cal($id, $team)
    {
        $temp1 = Bet::where('match_id', $id)->where('team', $team)->get();
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
        $data =Bet::where('match_id', $request->id)->where('team', $request->winner)->get();
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

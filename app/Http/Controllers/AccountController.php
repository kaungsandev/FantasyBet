<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //

    public function myprofile(Request $request)
    {
        $id = $request->id;
        $this->rankTitleCalculator($id);
        $user = User::where('id', $id)->first();
        //Get user bet history
        $record = Bet::where('supporter', $id)->orderBy('id', 'desc')->get();

        return view('profile', compact('user', 'record'));
    }

    public function rankTitleCalculator($id)
    {
        $user = User::where('id', $id)->first();
        if (is_null($user->rank_no)) {
            $user->rank_no = 0;
            $user->rank_title = 'rookie';
            $user->save();
        } else {
            $rank_no = $user->rank_no;
            if ($rank_no >= 0 && $rank_no <= 20) {
                $user->rank_title = 'တောသား';
                $user->save();
            } elseif ($rank_no >= 21 && $rank_no <= 50) {
                $user->rank_title = 'အထုံ';
                $user->save();
            } elseif ($rank_no >= 51 && $rank_no <= 100) {
                $user->rank_title = 'ရွာသား';
                $user->save();
            } elseif ($rank_no >= 100 && $rank_no <= 300) {
                $user->rank_title = 'သင်တန်းဆင်းလက်မှတ်ရပြီး';
                $user->save();
            } elseif ($rank_no >= 300 && $rank_no <= 500) {
                $user->rank_title = 'ဘွဲ့ရပညာတတ်';
                $user->save();
            } elseif ($rank_no > 500) {
                $user->rank_title = 'ဂုရု';
                $user->save();
            }
        }
    }
}

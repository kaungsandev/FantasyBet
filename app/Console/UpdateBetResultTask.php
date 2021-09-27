<?php

namespace App\Console;

use App\Http\Controllers\BetController;
use App\Models\Bet;
use App\Models\Fixture;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class UpdateBetResultTask{
    public function __invoke()
    {   
        if(Bet::all()->count()){
        //get finished matches;
        $fixtures = Fixture::where('finished',true)->where('started',true)->get();
        foreach ($fixtures as $fixture) {
           $bet_controller = new BetController();
           $bet_controller->updateBetResult($fixture);
        }
    }
    }
}
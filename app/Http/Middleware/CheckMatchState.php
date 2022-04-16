<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FixtureController;
use App\Models\Fixture;
use Closure;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class CheckMatchState
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $match= Fixture::findOrFail($request->id);
        $current_time = new DateTime('now',new DateTimeZone('UTC'));
        $kickoff_time = new DateTime($match->kickoff_time,new DateTimeZone('UTC'));
        if($current_time > $kickoff_time)
        {//Update Fixture data
            $FixtureController = new FixtureController();
            $FixtureController->updateSingleFixture($match);
        }
        if($match->finished == true){
            return redirect()->route('home')->with('info','The match is already finished');
        }else if($match->started == true ){
            return redirect()->route('home')->with('info','The match is already started');
        }
        return $next($request);
    }
}

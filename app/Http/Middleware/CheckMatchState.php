<?php

namespace App\Http\Middleware;

use App\Models\Fixture;
use Closure;
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
        if((boolean)$match->finished){
            return redirect()->route('home')->with('info','The match has already finished');
        }else if((boolean)$match->started){
            return redirect()->route('home')->with('info','The match is already started');
        }
        return $next($request);
    }
}

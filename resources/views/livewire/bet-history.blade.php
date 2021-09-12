<div class="w-4/6 mt-8">
    <h1 class="text-xl font-bold underline mb-2">History</h1>
    @foreach ($history as $each_bet)
    @php
    $match = $this->getMatch($each_bet->match_id)
    @endphp
    <div class="w-full font-bold bg-white p-4 grid grid-cols-5 text-theme-color mb-1 text-center rounded-lg">
        <p class="text-left text-gray-800">Gameweek {{$match->event}}</p>
        @if ($match->home_team == $each_bet->winner)
        <p>{{$this->getTeamName($match->home_team)}}</p>
        @elseif($match->away_team == $each_bet->winner)
        <p>{{$this->getTeamName($match->away_team)}}</p>
        @elseif($each_bet->winner == 'draw')
        <p>{{$this->getTeamShortName($match->home_team).'|'.$this->getTeamShortName($match->away_team)}} 
        <span class="text-green-400">Draw</span>
        </p>
        @endif
        <p>${{$each_bet->amount}}</p>  
        @if ($each_bet->paid == false && $match->finished == false)
        <p class="text-green-400">{{$each_bet->amount *  $each_bet->current_point}}</p>
        <p class="text-green-400">Pending</p>
        @elseif ($each_bet->paid ==false && $match->finished ==true)
        <p class="text-red-600"> -{{$each_bet->amount}}</p>
        <p class="text-red-600">Lose</p>
        @elseif ($each_bet->paid ==true && $match->finished ==true)
        <p class="text-blue-600">+ {{$each_bet->amount*$each_bet->current_point}}</p>
        <p class="text-blue-600">Win</p>
        @endif
      
    </div>
    @endforeach
</div>

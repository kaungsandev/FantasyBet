    <div class="w-full flex-col max-w-7xl mx-auto pt-6  px-4 sm:px-6 lg:px-8n">
        <!-- component -->
        @php $event = null; @endphp
        @foreach($fixtures as $fixture)
        @if($loop->first || $event != $fixture->event)
        @php $event = $fixture->event @endphp
        <p class="w-2/6 leading-relaxed font-bold m-2 text-xs lg:text-2xl text-theme-color pr-2 border-r-1">
            Gameweek {{$fixture->event}}
        </p>
        @endif
        <div class="flex-col text-md text-auto">
            <div class="w-full flex flex-row p-2 text-theme-color border-r-2 border-l-2 border-b-1 border-t-1 justify-evenly text-center shadow-sm  hover:border-purple-700 bg-gradient-to-r from-white to-white hover:from-purple-800 hover:to-yellow-400 hover:text-white">
                <p class="w-2/6 ">{{ $this->getTeamName($fixture->home_team) }}</p>
                <p class="w-2/6  bg-theme-color text-white">{{$fixture->home_team_score.' | '.$fixture->away_team_score}}</p>
                <p class="w-2/6">{{ $this->getTeamName($fixture->away_team) }}</p>         
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    
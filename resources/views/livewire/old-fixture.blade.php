    <div class="w-full flex-col mx-auto md:pt-6  md:px-4 sm:px-6 lg:px-8n">
        <!-- component -->
        @php $event = null; @endphp
        @foreach($fixtures as $fixture)
        @if($loop->first || $event != $fixture->event)
        @php $event = $fixture->event @endphp
        <p class="w-full md:w-2/6 leading-relaxed font-bold p-2 text-sm md:text-xs lg:text-2xl text-theme-color pr-2 border-r-1">
            Gameweek {{$fixture->event}}
        </p>
        @endif
        <div class="hidden md:flex flex-col text-md text-auto mb-1">
            <div class="w-full flex flex-row p-2 text-theme-color border-r-2 border-l-2 border-b-1 border-t-1 justify-evenly text-center shadow-sm  hover:border-purple-700 bg-gradient-to-r from-white to-white hover:from-purple-800 hover:to-yellow-400 hover:text-white">
                <p class="w-2/6 ">{{ $fixture->hometeam->name }}</p>
                <p class="w-2/6  bg-theme-color text-white">{{$fixture->home_team_score.' | '.$fixture->away_team_score}}</p>
                <p class="w-2/6">{{ $fixture->awayteam->name }}</p>         
            </div>
        </div>
        <div class="flex md:hidden flex-col text-md text-auto mb-1 rounded-md leading-relaxed">
            <div class="w-full flex flex-row p-2 text-theme-color border-r-2 border-l-2 border-b-1 border-t-1 justify-evenly text-center shadow-sm  hover:border-purple-700 bg-gradient-to-r from-white to-white hover:from-purple-800 hover:to-yellow-400 hover:text-white">
                <p class="w-2/6 ">{{ $fixture->hometeam->short_name }}</p>
                <p class="w-2/6  bg-theme-color text-white">{{$fixture->home_team_score.' | '.$fixture->away_team_score}}</p>
                <p class="w-2/6">{{ $fixture->awayteam->short_name}}</p>         
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    
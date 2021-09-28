<div class="w-full flex-col mx-auto pt-6  md:px-4 sm:px-6 lg:px-8n">
    <!-- component -->
    <div wire:loading.delay>...</div>    
    @php $kickoff_time = null; @endphp
    @foreach($fixtures as $fixture)
    @php
    $datetime = new DateTime($fixture->kickoff_time);
    $datetime->setTimeZone(new DateTimeZone(auth()->user()->timezone));
    @endphp
    @if ($fixture->finished !=true)
    @if($loop->first || $kickoff_time !== $datetime->format('l d F'))
    @php $kickoff_time = $datetime->format('l d F') @endphp
    <p class="w-full leading-relaxed font-bold p-2 text-xs lg:text-2xl text-theme-color pr-2 border-r-1">
        {{$datetime->format('l \, j F')}}  
    </p>
    @endif
    <div class="flex-col text-md text-auto">
        <a href="{{route('bet', ['id' => $fixture->id])}}" class=""> 
            <div class="w-full text-sm md:text-lg flex flex-row p-2 text-theme-color border-r-2 border-l-2 border-b-1 border-t-1 justify-evenly text-center shadow-sm  hover:border-purple-700 bg-gradient-to-r from-white to-white hover:from-purple-800 hover:to-yellow-400 hover:text-white">
                <p class="w-2/6 hidden md:block">{{ $fixture->hometeam->name }}</p>
                <p class="w-2/6 block md:hidden">{{ $fixture->hometeam->short_name }}</p>
                @if ($fixture->finished == false && $fixture->started == false)
                <p class="w-auto leading-relaxed bg-theme-color text-white pr-2 pl-2 rounded kickoff_time">
                    {{ $datetime->format('H:i A ') }}
                </p>
                @else
                <p class="w-2/6  bg-theme-color text-white">{{$fixture->home_team_score.' | '.$fixture->away_team_score}}</p>
                @endif
                <p class="w-2/6 hidden md:block">{{ $fixture->awayteam->name }}</p>
                <p class="w-2/6 block md:hidden">{{ $fixture->awayteam->short_name }}</p>         
            </div>
        </a>
    </div>
    <hr>
    @endif
    @endforeach
</div>
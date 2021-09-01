<div class="w-full flex-col max-w-7xl mx-auto pt-6  px-4 sm:px-6 lg:px-8n">
    <!-- component -->
    @php $kickoff_time = null; @endphp
    
    @foreach($fixtures as $fixture)
    @php
    $datetime = new DateTime($fixture->kickoff_time);
    $timezone = new DateTimeZone('Asia/Yangon');
    $datetime->setTimezone($timezone);
    @endphp
    @if ($fixture->finished !=true)
    @if($loop->first || $kickoff_time !== $datetime->format('l d F'))
    @php $kickoff_time = $datetime->format('l d F') @endphp
    <p class="w-2/6 leading-relaxed font-bold m-2 text-xs lg:text-2xl text-theme-color pr-2 border-r-1">
        {{$datetime->format('l d F')}}
    </p>
    @endif
    <div class="flex-col text-md text-auto">
        <a href="{{route('bet', ['id' => $fixture->event])}}" class=""> 
            <div class="w-full flex flex-row p-2 text-theme-color border-r-2 border-l-2 border-b-1 border-t-1 justify-evenly text-center shadow-sm  hover:border-purple-700 bg-gradient-to-r from-white to-white hover:from-purple-800 hover:to-yellow-400 hover:text-white">
                <p class="w-2/6 ">{{ $this->getTeamName($fixture->home_team) }}</p>
                @if ($fixture->finished == true && $fixture->started == true)
                <p class="w-2/6  bg-theme-color text-white">{{$fixture->home_team_score.' | '.$fixture->away_team_score}}</p>
                @elseif ($fixture->started === true)
                <p class="w-2/6 ">0 | 0</p>
                @else
                <p class="w-auto leading-relaxed bg-theme-color text-white pr-2 pl-2 rounded">
                        {{$datetime->format('h:i A')}}
                </p>
                @endif
                <p class="w-2/6">{{ $this->getTeamName($fixture->away_team) }}</p>         
            </div>
        </a>
    </div>
    @endif
    @endforeach
    <div class="w-full grid grid-cols-1 gap-1 mx-auto  py-4">
        @livewire('news-view')
    </div>
</div>
<div class="flex-col w-full pt-6 mx-auto md:px-4 sm:px-6 lg:px-8n">
    <!-- component -->
    <div wire:loading.delay>...</div>
    @php $kickoff_time = null; @endphp
    @foreach($fixtures as $fixture)
    @php
    $datetime = new DateTime($fixture->kickoff_time);
    $datetime->setTimeZone(new DateTimeZone(auth()->user()->timezone));
    @endphp

    @if($loop->first || $kickoff_time !== $datetime->format('l d F'))
    @php $kickoff_time = $datetime->format('l d F') @endphp
    <p class="w-full p-2 pr-2 text-xs font-bold leading-relaxed lg:text-2xl text-theme-color border-r-1">
        {{$datetime->format('l \, j F')}}
    </p>
    @endif
    <div class="flex-col text-md text-auto">
        <a id="match{{$fixture->id}}" href="{{ ($fixture->started == true) ? '#match'.$fixture->id : route('bet', ['id' => $fixture->id])}}">
            <div class="flex flex-row w-full p-2 text-sm text-center border-l-2 border-r-2 shadow-sm md:text-lg text-theme-color border-b-1 border-t-1 justify-evenly hover:border-purple-700 bg-gradient-to-r from-white to-white hover:from-purple-800 hover:to-gray-800 hover:text-white">
                <p class="hidden w-2/6 md:block">{{ $fixture->hometeam->name }}</p>
                <p class="block w-2/6 md:hidden">{{ $fixture->hometeam->short_name }}</p>
                @if ($fixture->finished == false && $fixture->started == false)
                <p class="w-auto pl-2 pr-2 leading-relaxed text-white rounded bg-theme-color kickoff_time">
                    {{ $datetime->format('H:i A ') }}
                </p>
                @else
                <p class="w-2/6 text-white bg-theme-color">{{$fixture->home_team_score.' | '.$fixture->away_team_score}}</p>
                @endif
                <p class="hidden w-2/6 md:block">{{ $fixture->awayteam->name }}</p>
                <p class="block w-2/6 md:hidden">{{ $fixture->awayteam->short_name }}</p>
            </div>
        </a>
    </div>
    <hr>

    @endforeach
</div>

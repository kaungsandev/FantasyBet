<div>
    <div
        class="w-full border border-blue-200 rounded-lg hover:shadow-lg hover:shadow-indigo-500/40 focus:bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 focus:text-white">
        <a
            @if ($fixture->finished) aria-disabled=true
            @else
            id="match{{ $fixture->id }}"
            href="{{ route('bet', ['id' => $fixture->id]) }}" @endif>
            <div class="grid items-center w-full grid-cols-3 p-2 text-sm font-bold text-center lg:text-md"
                id="fixture-template">
                {{-- Larger Device --}}
                <p class="hidden md:block">{{ $fixture->hometeam->name }}</p>
                {{-- Smaller Device --}}
                <p class="block md:hidden">{{ $fixture->hometeam->short_name }}</p>
                @if ($fixture->finished === false && $fixture->started === false)
                    <p class="">{{ $datetime->format('H:i A') }}</p>
                @else
                    <div class="flex flex-row justify-around p-2 space-x-2 font-bold text-white bg-gray-900 rounded-md">
                        <p class="w-full">{{ $fixture->home_team_score }}</p>
                        <p class="border border-gray-400"></p>
                        <p class="w-full">{{ $fixture->away_team_score }}</p>
                    </div>
                @endif
                {{-- Larger Device --}} <p class="hidden md:block">{{ $fixture->awayteam->name }}</p>
                {{-- Smaller Device --}}
                <p class="block md:hidden">{{ $fixture->awayteam->short_name }}</p>
            </div>
        </a>

    </div>
</div>

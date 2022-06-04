<div>
    <h1 class="pl-2 mb-2 text-xl font-bold text-left">History</h1>
    @foreach ($history as $each_bet)
        <div
            class="flex items-center justify-around w-full p-4 pt-4 mb-1 text-xs font-bold text-center align-middle bg-white rounded-lg flex-evenly md:text-md text-theme-color">

            <p class="pr-8 font-extrabold text-left">#{{ $loop->count - $loop->index }}
            </p>

            {{-- Game week or User name --}}
            @if ($match_id !== null)
                {{-- Show in each bet view --}}
                <div class="flex flex-row items-center w-full md:justify-around">
                    <img class="w-6 h-6 rouned-lg shadodw-lg"
                        src="{{ asset('img/avatars/' . 'avataaars-' . rand(1, 12) . '.png') }}" alt="">
                    <p class="w-full pl-4 text-center text-gray-800 md:pl-0">{{ $each_bet->user->name }}</p>
                </div>
            @else
                <p class="w-full text-left">
                    {{ $each_bet->fixture->hometeam->short_name . ' | ' . $each_bet->fixture->awayteam->short_name }}
                </p>
            @endif

            {{-- Team Choice --}}
            @if ($each_bet->winner === 'draw')
                <p class="w-full text-left">
                    Draw
                </p>
            @else
                <p class="w-full text-left">{{ $each_bet->team->name }}</p>
            @endif
            {{-- bet amount --}}
            <p class="hidden w-full text-right md:block">&euro;{{ $each_bet->amount }}</p>

            {{-- BET LOST --}}
            @if ($each_bet->paid == false && $each_bet->fixture->finished == true)
                <div class="w-full text-right "><span class="p-2 text-white bg-red-400 rounded-lg md:px-4 md:py-2">
                        -
                        &euro;{{ $each_bet->amount }}
                    </span></div>
                <p class="hidden w-full text-right text-red-400 uppercase md:block">LOST</p>
                {{-- BET WIN --}}
            @elseif($each_bet->paid == true && $each_bet->fixture->finished == true)
                <div class="w-full text-right"><span class="p-2 text-white bg-blue-500 rounded-lg md:px-4 md:py-2">
                        + &euro;{{ $each_bet->amount * $each_bet->current_point }}</span></div>
                <p class="hidden w-full text-right text-blue-500 uppercase md:block">WIN</p>
            @else
                {{-- BET PENDING --}}
                <p class="w-full text-right">&plusmn; &euro;{{ $each_bet->amount * $each_bet->current_point }}</p>
                <p class="hidden w-full text-right uppercase md:block">PENDING</p>
            @endif
        </div>
    @endforeach
</div>

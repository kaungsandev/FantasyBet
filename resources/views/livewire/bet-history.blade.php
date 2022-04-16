<div>
    <h1 class="text-xl text-left pl-2 font-bold mb-2">History</h1>
    @foreach ($history as $each_bet)
        <div
            class="w-full align-middle flex flex-evenly justify-around text-xs md:text-md items-center text-center  font-bold bg-white pt-4 p-4  text-theme-color mb-1  rounded-lg">

            <p class="text-left pr-8 font-extrabold">#{{ $loop->index+1 }}</p>

            {{-- Game week or User name --}}
            @if ($match_id !== null)
                {{-- Show in each bet view --}}
                <div class="w-full flex flex-row md:justify-around items-center">
                    <img class="w-6 h-6 rouned-lg shadodw-lg"
                        src="{{ asset('img/avatars/' . 'avataaars-' . rand(1, 12) . '.png') }}" alt="">
                    <p class="w-full pl-4 md:pl-0 text-center text-gray-800">{{ $each_bet->user->name }}</p>
                </div>
            @else
                <p class="w-full  text-left">
                    {{ $each_bet->fixture->hometeam->short_name . ' | ' . $each_bet->fixture->awayteam->short_name }}
                </p>
            @endif

            {{-- Team Choice --}}
            @if ($each_bet->winner == 'draw')
                <p class="w-full text-left">
                    Draw
                </p>
            @else
                <p class="w-full text-left">{{ $each_bet->team->name }}</p>
            @endif
            {{-- bet amount --}}
            <p class="w-full text-right hidden md:block">&euro;{{ $each_bet->amount }}</p>

            {{-- BET LOST --}}
            @if ($each_bet->paid == false && $each_bet->fixture->finished == true)
                <div class="w-full text-right "><span class="bg-red-400 text-white md:px-4 md:py-2 p-2 rounded-lg">
                     -
                        &euro;{{ $each_bet->amount }}
                </span></div>
                <p class="w-full hidden md:block   text-right uppercase text-red-400">LOST</p>
                {{-- BET WIN --}}
            @elseif($each_bet->paid == true && $each_bet->fixture->finished == true)
                <div class="w-full  text-right"><span class="bg-blue-500 text-white md:px-4 md:py-2 p-2 rounded-lg">
                    + &euro;{{ $each_bet->amount * $each_bet->current_point }}</span></div>
                <p class="w-full hidden md:block   text-right uppercase text-blue-500">WIN</p>
            @else
            {{-- BET PENDING --}}
                <p class="w-full   text-right">&plusmn; &euro;{{ $each_bet->amount * $each_bet->current_point }}</p>
                <p class="w-full hidden md:block   text-right uppercase">PENDING</p>
            @endif
        </div>
    @endforeach
</div>

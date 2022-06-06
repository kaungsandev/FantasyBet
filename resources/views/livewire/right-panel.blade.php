<div class="hidden p-8 lg:w-1/3 lg:sticky lg:top-0 lg:h-screen lg:flex">
    <div class="flex flex-col w-full space-y-4">

        <x-nav-link href="{{ route('billing') }}"
            class="w-full bg-white rounded-lg text-theme-color hover:border-none hover:shadow-none">
            <x-slot:icon>
                <i class="fas fa-wallet"></i>
            </x-slot:icon>
            <p class="w-full text-lg text-right">
                &euro; {{ number_format(auth()->user()->coin) }}
            </p>
        </x-nav-link>

        <div class="hidden w-full bg-white rounded-md shadow-md md:flex-col md:flex">
            <h1 class="w-full p-2 text-lg font-bold text-white bg-theme-color rounded-t-md">Best 10</h1>
            <div class="flex flex-row justify-between p-2 text-center text-gray-400 border-b-2 border-gray-200">
                <p>Name</p>
                <p>Pts</p>
            </div>
            @foreach ($players as $player)
                @php
                    $player = (object) $player;
                @endphp

                @if ($loop->last)
                    <div class="flex flex-row justify-between p-2 ">
                        <p>{{ $player->web_name }}</p>
                        <p>{{ $player->event_points }}</p>
                    </div>
                @else
                    <div class="flex flex-row justify-between p-2 border-b-2 border-gray-100">
                        <p>{{ $player->web_name }}</p>
                        <p>{{ $player->event_points }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

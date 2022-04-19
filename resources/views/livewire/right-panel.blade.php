<div class="hidden p-8 lg:w-1/5 lg:sticky lg:top-0 lg:h-screen lg:flex">
    <div class="flex flex-col w-full">
        <div class="w-full p-2 mb-8  rounded shadow-md bg-gray-100">
            <x-nav-link href="{{route('billing')}}" class="w-full text-center  border-l-2 text-theme-color hover:border-purple-700 hover:text-purple-700">
                <div class="flex flex-row justify-end w-full p-2 pl-4 text-lg text-right">
                    <p class="text-theme-color">
                        &euro;{{number_format(auth()->user()->coin)}}
                    </p>
                    <p class="w-full text-gray-400">
                        <i class="fas fa-wallet"></i>
                    </p>
                </div>
            </x-nav-link>
        </div>
        <div class="hidden w-full bg-white rounded-md shadow-md md:flex-col md:flex">
            <h1 class="w-full p-2 text-lg font-bold text-white bg-theme-color rounded-t-md">Best 10</h1>
            <div class="flex flex-row justify-between p-2 text-center text-gray-400 border-b-2 border-gray-200">
                <p>Name</p>
                <p>Pts</p>
            </div>
            @foreach ($players as $player)
            @php
                $player=(object)$player;
            @endphp

            @if ($loop->last)
            <div class="flex flex-row justify-between p-2 ">
                <p>{{$player->web_name}}</p>
                <p>{{$player->event_points}}</p>
            </div>
            @else
            <div class="flex flex-row justify-between p-2 border-b-2 border-gray-100">
                <p>{{$player->web_name}}</p>
                <p>{{$player->event_points}}</p>
            </div>
            @endif

            @endforeach
        </div>
    </div>
</div>

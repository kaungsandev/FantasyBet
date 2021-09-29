<div class="hidden md:flex w-full p-8 sticky top-0 h-screen">
    <div class="w-full flex flex-col">
        <div class="w-full rounded shadow-md p-2 bg-white mb-8">
            <x-nav-link href="{{route('billing')}}" class="w-full text-theme-color border-l-2 bg-white text-center hover:border-purple-700 hover:text-purple-700">
                <div class="w-full p-2 pl-4 flex flex-row justify-end text-right text-lg">
                    <p class="text-theme-color">
                        &euro;{{auth()->user()->coin}}
                    </p>
                    <p class="w-full text-gray-400">
                        <i class="fas fa-wallet"></i>
                    </p>          
                </div>
            </x-nav-link>
        </div>
        <div class="w-full bg-white shadow-md rounded-md">
            <h1 class="w-full text-lg font-bold p-2 bg-theme-color  rounded-t-md text-white">Best 10</h1>
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
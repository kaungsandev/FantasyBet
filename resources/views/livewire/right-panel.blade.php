<div class="hidden p-8 lg:w-1/3 overflow-y-auto no-scrollbar lg:flex">
    <div class="flex flex-col w-full space-y-4">

        <x-wallet-card />

        <div class="hidden w-full bg-white rounded-md shadow-md md:flex-col md:flex">
            <h1 class="w-full p-2 text-lg font-bold text-white bg-theme-color rounded-t-md">Top 10</h1>
            <div class="flex flex-row justify-between p-2 text-center text-gray-400 border-b-2 border-gray-200">
                <p>Name</p>
                <p>Pts</p>
            </div>
            @foreach ($players->sortByDesc('event_points') as $player)
                <div class="flex justify-between p-4 font-bold items-center">
                    <div class="flex space-x-2">
                        <p>{{ $player['element_type'] }}</p>
                        <p>{{ $player['web_name'] }}</p>
                    </div>
                    <p>{{ $player['event_points'] }}</p>

                </div>
            @endforeach
        </div>
    </div>
</div>

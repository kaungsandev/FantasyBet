<div
    class="grid rounded-md shadow-md bg-gradient-to-r from-white via-yellow-200 to-blue-200 dark:bg-gray-700 shadow-sky-400">
    {{-- header --}}
    <div class="flex flex-col w-full px-4 py-4 space-y-2 border-b">
        <div class="flex flex-row items-center justify-between text-xl font-bold dark:text-gray-600">
            <p class=" dark:text-gray-200">{{ $player['web_name'] }}</p>
            <p><span class="pr-1">&pound;</span>{{ number_format($player['now_cost'] / 10, 1) }}</p>
        </div>

        <div class="flex flex-row items-center justify-between text-xs font-extrabold text-gray-600 dark:text-gray-600">
            <p>{{ $team->name }}</p>
            <p>{{ $player_type_long }}</p>
        </div>
    </div>
    {{-- News --}}
    <div>
        <p class="items-center p-4 text-xs font-bold leading-relaxed text-gray-800 dark:text-gray-200">
            <span class="text-gray-600">News:</span>
            {{ $player['news'] }}
        </p>
    </div>
    {{-- Stats --}}
    <div class="grid self-stretch w-full grid-rows-4 space-y-1 shadow-inner dark:bg-gray-400 rounded-b-md">
        <div class="grid w-full grid-cols-4 gap-4 px-4 py-2 text-xs text-center text-gray-600 dark:text-gray-200">
            <p>Form</p>
            <p>Points</p>
            <p>Total</p>
            <p>TSB</p>
        </div>
        <div
            class="grid grid-cols-4 gap-4 px-4 py-2 font-bold text-center text-md place-items-center dark:text-gray-100">
            <p>{{ $player['form'] }}</p>
            <p>{{ $player['event_points'] }} pts</p>
            <p>{{ $player['total_points'] }} pts</p>
            <p>{{ $player['selected_by_percent'] }}%</p>
        </div>
        <div class="grid grid-cols-4 gap-4 px-4 py-2 text-xs text-center text-gray-600 dark:text-gray-200">
            <p>Goal Scored</p>
            <p>Goal Conceded</p>
            <p>Assists</p>
            <p>Clean Sheets</p>
        </div>
        <div
            class="grid grid-cols-4 gap-4 px-4 py-2 font-bold text-center text-md place-items-center dark:text-gray-100">
            <p>{{ $player['goals_scored'] }}</p>
            <p>{{ $player['goals_conceded'] }}</p>
            <p>{{ $player['assists'] }}</p>
            <p>{{ $player['clean_sheets'] }}</p>
        </div>
        <div
            class="flex flex-row justify-between p-4 text-gray-500 bg-white rounded-b-lg dark:bg-gray-400 dark:text-gray-200">
            <div class="flex items-center space-x-4 text-sm font-bold">
                <p>Transfer In: <span>{{ $player['transfers_in'] }}</span></p>
            </div>

            <div class="flex items-center space-x-4 text-sm font-bold">
                <p>Transfer Out: <span>{{ $player['transfers_out'] }}</span></p>
            </div>
        </div>
    </div>
    {{-- Action --}}
    {{-- <div class="flex flex-row items-end w-full">
        <p class="w-full h-12 py-2 font-bold leading-relaxed text-center dark:text-gray-200">
            Pts
        </p>
        <button class="w-full h-12 font-bold hover:bg-sky-500 hover:text-white dark:text-gray-200">
            BUY
        </button>
    </div> --}}
</div>

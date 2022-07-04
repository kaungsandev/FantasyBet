<div class="w-full h-auto flex flex-col bg-white dark:bg-gray-700 shadow-lg rounded-md">
    {{-- header --}}
    <div class="px-4 py-4 w-full flex flex-col space-y-2 border-b">
        <p class="font-bold text-xl dark:text-gray-200">{{ $player['web_name'] }}</p>
        <div class="flex flex-row justify-between text-gray-500 text-xs font-extrabold dark:text-gray-400">
            <p>{{ $team->name }}</p>
            <p>{{ $player_type_long }}</p>
        </div>
    </div>
    {{-- status --}}
    <div>
        <p class="text-gray-800 dark:text-gray-200 p-4 items-center text-xs font-bold leading-relaxed">
            <span class="text-gray-400">Status:</span> Joined Reading on loan until
            the end of the season - Expected back 01 Jul.
        </p>
    </div>
    {{-- Stats --}}
    <div class="grid grid-rows-4 w-full bg-gray-200 self-stretch space-y-1 dark:bg-gray-400">
        <div class="w-full grid grid-cols-4 gap-4 px-4 py-2 text-center text-xs text-gray-400 dark:text-gray-200">
            <p>Form</p>
            <p>Previous Round</p>
            <p>Total</p>
            <p>TSB</p>
        </div>
        <div
            class="grid grid-cols-4 gap-4 px-4 py-2 text-center text-xs font-bold text-gray-600 place-items-center dark:text-gray-100">
            <p>2.5</p>
            <p>12 pts</p>
            <p>126 pts</p>
            <p>96%</p>
        </div>
        <div class="grid grid-cols-4 gap-4 px-4 py-2 text-center text-xs text-gray-400 dark:text-gray-200">
            <p>Goal Scored</p>
            <p>Goal Conceded</p>
            <p>Assists</p>
            <p>Clean Sheets</p>
        </div>
        <div
            class="grid grid-cols-4 gap-4 px-4 py-2 text-center text-xs font-bold text-gray-600 place-items-center dark:text-gray-100">
            <p>2.5</p>
            <p>12 pts</p>
            <p>126 pts</p>
            <p>96%</p>
        </div>
        <div class="flex flex-row justify-between bg-white p-4 dark:bg-gray-400 text-gray-500 dark:text-gray-200">
            <div class="flex items-center space-x-4 font-bold text-sm">
                <p>Transfer In: <span>95%</span></p>
            </div>

            <div class="flex items-center space-x-4 font-bold text-sm">
                <p>Transfer Out: <span>75%</span></p>
            </div>
        </div>
    </div>
    {{-- Transfer --}}
    <div class="w-full flex flex-row items-end">
        <p class="w-full text-center h-12 py-2 font-bold leading-relaxed dark:text-gray-200">
            Pts
        </p>
        <button class="hover:bg-sky-500 hover:text-white w-full h-12 font-bold dark:text-gray-200">
            BUY
        </button>
    </div>
</div>

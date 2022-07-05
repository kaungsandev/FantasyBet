<div class="flex flex-col space-y-2 overflow-y-auto no-scrollbar">
    <div class="flex flex-row items-center justify-between w-full ">
        <input type="search" wire:model.lazy='search' placeholder="Search Here..."
            class="w-full px-4 py-3 font-thin duration-100 rounded shadow focus:outline-none focus:shadow-lg focus:shadow-slate-200 shadow-gray-100">
        @if (count($search_result))
            <h1 class="w-full text-lg font-bold text-center">Found Player</h1>
        @elseif(!count($search_result) && $search !== null && $search !== '')
            <h1 class="w-full text-lg font-bold text-center">No player found.</h1>
        @endif
    </div>
    <div class="flex flex-col">

        <div class="grid w-full gap-2 lg:grid-cols-3">
            @foreach ($search_result as $player)
                @livewire('player-card', ['player' => $player, 'teams' => $teams], key($player['web_name']))
            @endforeach
        </div>
    </div>
    <h1 class="w-full text-lg font-bold text-center">{{ $teams->where('id', $team_id)->first()->name }}</h1>
    <div class="grid w-full gap-2 lg:grid-cols-3">

        @foreach ($player_by_team as $player)
            @livewire('player-card', ['player' => $player, 'teams' => $teams], key($player['id']))
        @endforeach

    </div>
</div>

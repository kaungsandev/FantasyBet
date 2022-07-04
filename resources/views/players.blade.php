<x-app-layout>
    @section('page_title', 'Players')
    <div class="flex flex-row justify-around space-x-4 overflow-y-auto no-scrollbar h-auto">

        <div class="w-full grid grid-cols-3 gap-2 overflow-y-auto no-scrollbar">
            @foreach ($paginatedPlayers as $players)
                @foreach ($players as $player)
                    @livewire('player-card', ['player' => $player, 'teams' => $teams], key($player['id']))
                @endforeach
            @endforeach
        </div>
        <div class="flex flex-col bg-white rounded-lg p-4 space-y-2 w-64">
            <h1 class="font-bold border-b">Teams</h1>
            <div class="flex flex-col space-y-2 justify-between h-full text-gray-400">
                @foreach ($teams as $team)
                    <a class="@if ($players->currentPage() === $team->id) font-bold text-gray-800 @endif"
                        href="{{ route('players.team', ['page' => $team->id, 'team' => $team->name]) }}">
                        {{ $team->name }}
                    </a>
                @endforeach
            </div>

        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                var $search = $("#searchBar").on('keyup', function() {
                    var matcher = new RegExp($(this).val(), 'gi');
                    $('.player-card').show().not(function() {
                        return matcher.test($(this).find('.player-name').text())
                    }).hide();
                })
            })
        </script>
    @endsection
</x-app-layout>

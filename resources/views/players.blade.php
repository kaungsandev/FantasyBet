<x-app-layout>
    @section('page_title', 'Players')
    <div class="flex flex-row justify-around h-auto space-x-4 overflow-y-auto no-scrollbar">

        <div class="grid w-full gap-2 overflow-y-auto lg:grid-cols-3 no-scrollbar">

            @foreach ($players as $player)
                @livewire('player-card', ['player' => $player, 'teams' => $teams], key($player['id']))
            @endforeach

        </div>
        <div class="flex flex-col w-64 p-4 space-y-2 overflow-y-auto bg-white rounded-lg no-scrollbar">
            <h1 class="font-bold border-b">Teams</h1>
            <div class="flex flex-col justify-between h-full px-4 py-2 space-y-2 text-sm text-gray-400">
                @foreach ($teams as $team)
                    <a class="@if ($team_id == $team->id) font-bold text-lg  text-blue-400  rounded-t-lg rounded-b-md @endif"
                        href="{{ route('players', ['team' => $team->id, 'team_name' => $team->name]) }}">
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

<div class="w-full flex flex-col">
    @php
    // Make next pagination show in same page.
    // If not add withPath(''), pagination will return to home page.
    $paginatedPlayers->withPath(''); 
    @endphp
    <div class="w-full mb-8 sticky top-0 h-auto pt-8 bg-white">
        {{$paginatedPlayers->links()}}
      <div class="flex flex-row  mt-8  justify-between items-center">
        <h1 class="w-full text-center font-bold  text-theme-color ">{{$this->getTeamName($paginatedPlayers->currentPage())}}</h1>
        <input class="w-full bg-theme-color text-white focus:ring-4 focus:ring-gray-800 focus:ring-opacity-50 border-none rounded" id="searchBar" type="text" placeholder="Search by name" required>
      </div>
    </div>
    <div class="w-full grid grid-cols-3 gap-3" id="card-container">
        @foreach ($paginatedPlayers as $players)        
        @foreach ($players as $player)
        @php
           $player= (object)$player;
        @endphp
       <div class="player-card w-full flex flex-row text-black h-auto default-bg-color border-2 border-gray-100 rounded-xl shadow-md mb-8">
        {{-- Profile --}}
            <div class="w-full flex flex-col justify-between p-8">
                {{-- name/price --}}
                <div class="flex flex-row justify-between font-bold items-top">
                    <p class="player-name text-left text-xl leading-tight">
                        {{$player->first_name .' '.$player->web_name}}
                    </p>
                    <p class="text-right text-xs">{{$this->playerType($player->element_type)}}</p>
                    {{-- <p class="text-right text-md">&euro; {{number_format($player->now_cost/10,1,'.','')}}</p> --}}
                </div>
                {{-- news--}}
                <p class="text-sm mt-2 text-red-400 leading-relaxed">{{$player->news}}</p>
                {{-- stats --}}
                @if ($player->element_type == 3 || $player->element_type == 4)
                <div class="flex flex-col justify-around mt-2 rounded-xl text-gray-400 font-bold p-2">
                    <div class="flex flex-row text-start justify-between">
                        <p>Goals Scored</p>
                        <p>{{$player->goals_scored}}</p>
                    </div>
                    <div class="flex flex-row text-start justify-between">
                        <p>Assists</p>
                        <p>{{$player->assists}}</p>
                    </div>
                    <div class="flex flex-row text-start justify-between">
                        <p>Clean Sheets</p>
                        <p>{{$player->clean_sheets}}</p>
                    </div>
                </div>
                @elseif ($player->element_type == 2)
                <div class="flex flex-col justify-around mt-2 rounded-xl text-gray-400 font-bold p-2">
                    <div class="flex flex-row text-start justify-between">
                        <p>Goals Conceded</p>
                        <p>{{$player->goals_conceded}}</p>
                    </div>
                    <div class="flex flex-row text-start justify-between">
                        <p>Assists</p>
                        <p>{{$player->assists}}</p>
                    </div>
                    <div class="flex flex-row text-start justify-between">
                        <p>Clean Sheets</p>
                        <p>{{$player->clean_sheets}}</p>
                    </div>
                </div>
                @elseif ($player->element_type == 1)
                <div class="flex flex-col justify-around mt-2 rounded-xl text-gray-400 font-bold p-2">
                    <div class="flex flex-row text-start justify-between">
                        <p>Goals Conceded</p>
                        <p>{{$player->goals_conceded}}</p>
                    </div>
                    <div class="flex flex-row text-start justify-between">
                        <p>Saves</p>
                        <p>{{$player->saves}}</p>
                    </div>
                    <div class="flex flex-row text-start justify-between">
                        <p>Clean Sheets</p>
                        <p>{{$player->clean_sheets}}</p>
                    </div>
                </div>
                @endif
                {{-- Call to Action Button --}}
                <div class="flex flex-row justify-around mt-2">
                    <a href="" class="p-4 text-center w-full h-auto rounded-xl border-2 border-gray-200 hover:bg-black hover:text-white hover:shadow">
                        View profile
                    </a>
                </div>
            </div>
           
    </div>
       @endforeach
        @endforeach
    </div>
    @section('scripts')
    <script>
        $(document).ready(function(){
            var $search = $("#searchBar").on('keyup',function(){
                var matcher = new RegExp($(this).val(), 'gi');
                $('.player-card').show().not(function(){
                    return matcher.test($(this).find('.player-name').text())
                }).hide();
            })
        })        
    </script>
    @endsection
    
</div>

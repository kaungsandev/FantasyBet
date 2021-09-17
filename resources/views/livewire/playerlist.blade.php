<div class="w-full flex flex-col">
    <div class="w-full mb-8 sticky top-0 h-auto pt-8">
        <input class="w-full bg-transparent focus:bg-white focus:ring-4 focus:ring-yellow-500 focus:ring-opacity-50 border-none rounded" id="searchBar" type="text" placeholder="Search by name" required>
    </div>
    <div class="w-full grid grid-cols-1" id="card-container">
        @foreach ($players as $item)
        @php
        $item = (object) $item;
        @endphp
        <div class="w-full h-auto  mb-2 rounded-md shadow  border-l-4 border-indigo-400   text-center">
            <div class="flex flex-1 bg-white text-center">
                <div class="w-1/4 flex flex-col p-8 justify-center">
                    <h5 class="text-md">{{$item->first_name. ' '.$item->second_name}}</h5>
                    <p class="text-xs text-red-800 mb-0">{{$item->news}}</p>
                </div>
                <div class="w-1/8 p-8">
                    <p><i class="far fa-clock"></i> {{$item->minutes}}min</p>
                </div>
                <div class="w-1/8 p-8">
                    <p>Penalty Saved:</p><p> {{$item->penalties_saved}}</p>
                </div>
                <div class="w-1/8 p-8">
                    <p>Clean Sheets:</p><p>{{$item->clean_sheets}}</p>
                </div>
                <div class="w-1/8 p-8">
                    <p>Goals conceded:</p><p> {{$item->goals_conceded}}</p>
                </div>
                <div class="w-1/8 p-8">
                    <p>Goals Score:</p><p> {{$item->goals_scored}}</p>
                </div>
                <div class="w-1/8 p-8">
                    <p>Assits: </p><p>{{$item->assists}}</p>
                </div>
                <div class="w-1/8 p-8 pt-8  ">
                    <p></p><p>$ {{$item->now_cost/10}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @section('scripts')
    <script>  
        $(document).ready(function(){
            var $search = $("#searchBar").on('input',function(){
                var matcher = new RegExp($(this).val(), 'gi');
                $('.box').show().not(function(){
                    return matcher.test($(this).find('.card-title').text())
                }).hide();
            })
        })
        
        
    </script>
    @endsection
    
</div>

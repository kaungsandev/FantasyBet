<div class="w-full flex-col max-w-7xl mx-auto  px-4 sm:px-6 lg:px-8n">
    <!-- component -->
    @php $matchday = null; @endphp
    @foreach($matches as $match)
    @if($loop->first || $matchday != $match->matchday)
    @php $matchday = $match->matchday @endphp
    <h1 class="font-bold m-2 text-xs lg:text-2xl">Matchday {{$matchday}}</h1>
    @endif
    <div class=" flex-col p-5 text-xs lg:text-2xl text-auto ">
        <a href="{{route('bet', ['id' => $match->id])}}"> 
            <div class="w-full flex justify-between border-b-2 border-r-2 border-l-2 border-gray-400 p-2 bg-white bg-opacity-50 text-black text-center hover:bg-red-400">
                <p class="w-2/6 m-2">{{ $match->homeTeam }}</p>
                <p class="w-1/6 m-2">{{$match->result}}</p>
                <p class="w-2/6 m-2">{{ $match->awayTeam }}</p>         
                @if ($match->status == "FINISHED")
                <p class="w-1/6 m-2 text-gray-600 lg:text-xl">{{$match->status}}</p>
                @else
                <p class="w-1/6 m-2 text-gray-600 lg:text-xl">{{date("F j ,g:i A", strtotime($match->time))}}</p>
                @endif
            </div>
        </a>
    </div>
    @endforeach
</div>
<div class="w-full flex-col max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8n">
    @php $matchday = null; @endphp
    @foreach($matches as $match)
    @if($loop->first || $matchday != $match->matchday)
    @php $matchday = $match->matchday @endphp
    <h5 class="font-semibold text-2xl text-gray-800">Matchday {{ $matchday }}</h5>
    @endif
    <a href="{{route('bet', ['id' => $match->id])}}" class="">
        <div class="shadow-lg bg-card p-3 mb-2 border-l-2 border-r-2 border-red-700 rounded flex-col text-xs lg:text-lg hover:text-white hover:bg-blue-700 hover:border-transparent">
            <p class="w-full text-center text-xs p-5">{{date("F j ,g:i A", strtotime($match->time))}}</p>
            <div class="flex justify-around hover:hidden">
                <p class="w-1/3 px-2">{{ $match->homeTeam }}</p>
                <p class="w-1/3 px-2 text-center">Vs</p>
                <p class="w-1/3 px-2">{{ $match->awayTeam }}</p>
            </div>
        </div>
    </a>
    @endforeach
</div>
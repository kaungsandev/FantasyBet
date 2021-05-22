<div class="w-full flex-col max-w-7xl mx-auto  px-4 sm:px-6 lg:px-8n">
    <!-- component -->
<div class="table w-full p-2">
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Match Day
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Home Team
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Away Team
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Time
                    </div>
                </th>
                <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                    <div class="flex items-center justify-center">
                        Action
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @php $matchday = null; @endphp
            @foreach($matches as $match)
            @if($loop->first || $matchday != $match->matchday)
            @php $matchday = $match->matchday @endphp
            @endif
            <tr class="bg-gray-100 text-center border-b text-sm text-gray-600">
                <td class="p-2 border-r">{{$matchday }}</td>
                <td class="p-2 border-r">{{$match->homeTeam}}</td>
                <td class="p-2 border-r">{{ $match->awayTeam }}</td>
                <td class="p-2 border-r">{{date("F j ,g:i A", strtotime($match->time))}}</td>
                @if (auth()->user()->admin)
                <td>
                    <a href="#" class="bg-blue-500 p-2 text-white hover:shadow-lg text-xs font-thin">Edit</a>
                    <a href="#" class="bg-red-500 p-2 text-white hover:shadow-lg text-xs font-thin">Remove</a>
                </td>
                @else
                <td class="w-auto h-auto bg-blue-700 text-white hover:bg-red-700 hover:shadow-lg hover:cursor-pointer">
                    <a href="{{route('bet', ['id' => $match->id])}}" class="text-xs font-thin">Bet</a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
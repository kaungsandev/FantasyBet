<div class="w-full pt-8 flex flex-col">
<table class="w-full rounded-lg">
    <thead>
        <tr class="w-full text-center text-white bg-theme-color">
            <td class="px-4 py-2">Id</td>
            <td class="px-4 py-2">Event</td>
            <td class="px-4 py-2">Home Team</td>
            <td class="px-4 py-2">Home Team Score</td>
            <td class="px-4 py-2">Away Team Score</td>
            <td class="px-4 py-2">Away Team</td>
            <td class="px-4 py-2">Kickoff Time</td>
        </tr>
    </thead>
    <tbody> 
        @foreach ($fixtures as $fixture)
        <tr wire:click="$emit('editFixture',{{$fixture->id}})" class="w-full text-center text-theme-color bg-white border-b-2 border-gray-200 hover:bg-gray-900 hover:shadow-lg cursor-pointer hover:text-gray-200">
            <td class="px-4 py-2">#{{$fixture->id}}</td>
            <td class="px-4 py-2">{{$fixture->event}}</td>
            <td class="px-4 py-2">{{$fixture->hometeam->name}}</td>
            <td class="px-4 py-2">{{$fixture->home_team_score}}</td>
            <td class="px-4 py-2">{{$fixture->away_team_score}}</td>
            <td class="px-4 py-2">{{$fixture->awayteam->name}}</td>
            <td class="px-4 py-2">{{$fixture->kickoff_time}} UTC</td>
        </tr>
        @endforeach
        {{$fixtures->links()}}
    </tbody>
</table>
</div>
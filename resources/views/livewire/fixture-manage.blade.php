<div class="w-full pt-8 flex flex-col">
    @include('components.messages')
<div class="flex  flex-row justify-around align-center items-center mb-1">
    <h1 class="w-full text-3xl font-auto h-auto">Fixtures</h1>
   <div class="w-full flex flex-row justify-end">
    <button wire:click="updateBets" class="w-1/4 bg-theme-color text-white hover:bg-gray-600 hover:text-white px-2 py-2 rounded-md mr-2">Update Bets</button>
    <button wire:click="updateFixtures" class="w-1/4 bg-theme-color text-white hover:bg-gray-600 hover:text-white px-2 py-2 rounded-md">Update Fixtures</button>
   </div>
</div>
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
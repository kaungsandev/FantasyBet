<div class="flex flex-col w-full pt-8">
    @include('components.messages')
<div class="flex flex-row items-center justify-around mb-1 align-center">
    <h1 class="w-full h-auto text-3xl font-auto">Fixtures</h1>
   <div class="flex flex-row justify-end w-full space-x-4">
    <button wire:click="refreshFixture" class="w-1/4 px-2 py-2 mr-2 text-white rounded-md bg-theme-color hover:bg-gray-600 hover:text-white">Refresh Fixtures</button>
    <button wire:click="updateBets" class="w-1/4 px-2 py-2 mr-2 text-white rounded-md bg-theme-color hover:bg-gray-600 hover:text-white">Update Bets</button>
    <button wire:click="updateFixtures" class="w-1/4 px-2 py-2 text-white rounded-md bg-theme-color hover:bg-gray-600 hover:text-white">Update Fixtures</button>
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
        <tr wire:click="$emit('editFixture',{{$fixture->id}})" class="w-full text-center bg-white border-b-2 border-gray-200 cursor-pointer text-theme-color hover:bg-gray-900 hover:shadow-lg hover:text-gray-200">
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
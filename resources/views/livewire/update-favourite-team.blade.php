<div>
   <form class="flex flex-row justify-center mt-8 items-center p-4" wire:submit.prevent="updateFavTeam">
       <label class="font-bold pr-8" for="team">Please select your favourite team.</label>
    <select class="w-1/3" wire:model='selectedTeam' name="team" id="team">
        @foreach ($teams as $team)
            @if ($loop->first)
            <option>Teams</option>
            @endif
            <option value="{{$team->id}}">{{$team->name}}</option>
        @endforeach
    </select>
    <button class="w-auto p-2 bg-theme-color text-white">Update</button>
   </form>
</div>

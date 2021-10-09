<div class="w-full flex flex-col ">
    <div class="w-full flex flex-col justify-between p-5">
        @include('components.messages')
        <h1 class="font-bold text-lg pb-5">@if ($updateForm == false)
            Create Fixture
            @else
            Update Fixture
        @endif</h1>
        <form wire:submit.prevent="submit">
            <div class="-mx-3 md:flex flex-col mb-6">
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Event
                    </label>
                    <input wire:model="event" class="appearance-none block text-xs w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="event">
                    @error("event")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="w-full flex flex-row">
                    <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                            Home Team
                        </label>
                        <select wire:model="home_team" class="appearance-none block text-xs w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" placeholder="Jane">
                           @foreach ($teams as $team)
                               <option value="{{$team->id}}">{{$team->name}}</option>
                           @endforeach
                        </select>
                        @error("home_team")
                        <p class="text-red text-xs italic">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="md:w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                            Away Team
                        </label>
                        <select wire:model="away_team" class="appearance-none block text-xs w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" placeholder="Jane">
                            @foreach ($teams as $team)
                            <option value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                        </select>
                        @error("away_team")
                        <p class="text-red text-xs italic">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Time
                    </label>
                    <input wire:model="kickoff_time" class="appearance-none block text-xs w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="datetime-local" placeholder="Jane">
                    @error("kickoff_time")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
              <div class="w-full flex flex-row">
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Home Team Score
                    </label>
                    <input wire:model="home_team_score" class="appearance-none block text-xs w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="number" placeholder="Jane">
                    @error("home_team_score")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Away Team Score
                    </label>
                    <input wire:model="away_team_score" class="appearance-none block text-xs w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="number" placeholder="Jane">
                    @error("away_team_score")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
              </div>
               <div class="w-full flex flex-row">
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Started
                    </label>
                    <select wire:model="started" class="appearance-none block text-xs w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" placeholder="Jane">
                        <option value=1>True</option>
                        <option value=0>False</option>
                    </select>
                    @error("started")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Finished
                    </label>
                    <select wire:model="finished" class="appearance-none block text-xs w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" placeholder="Jane">
                        <option value=1>True</option>
                        <option value=0>False</option>
                    </select>
                    @error("finished")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
               </div>
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Type
                    </label>
                    <select wire:model="fixture_type" class="appearance-none block text-xs w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" placeholder="Jane">
                        <option value="football">Football</option>
                        <option value="dota2">Dota 2</option>
                    </select>
                    @error("fixture_type")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-full px-3">
                    <button type="submit" class="w-full bg-blue-700 mt-6 hover:bg-blue-dark text-white font-bold py-3 px-4 rounded">
                       @if ($updateForm == false)
                           Create
                           @else
                           Update
                       @endif
                    </button>
                </div>
               
            </form>
    </div>
</div>
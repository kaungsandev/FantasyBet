<div class="w-full flex flex-col ">
    <div class="w-full flex flex-col justify-between p-5">
        @include('components.messages')
        <h1 class="font-bold text-lg pb-5">@if ($updateForm == false)
            Create Fixture
            @else
            Update Fixture
        @endif</h1>
        <p>{{$this->fixture_type}}, {{$this->started}}</p>
        <form wire:submit.prevent="submit">
            <div class="-mx-3 md:flex flex-row mb-6">
               <div class="flex flex-col w-full">
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Event
                    </label>
                    <input wire:model="event" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="event">
                    @error("event")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Home Team
                    </label>
                    <select wire:model="home_team" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" placeholder="Jane">
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
                    <select wire:model="away_team" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" placeholder="Jane">
                        @foreach ($teams as $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                    </select>
                    @error("away_team")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Time
                    </label>
                    <input wire:model="kickoff_time" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="datetime-local" placeholder="Jane">
                    @error("kickoff_time")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Home Team Score
                    </label>
                    <input wire:model="home_team_score" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="number" placeholder="Jane">
                    @error("home_team_score")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
               </div>
               <div class="flex flex-col w-full">
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Away Team Score
                    </label>
                    <input wire:model="away_team_score" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="number" placeholder="Jane">
                    @error("away_team_score")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Started
                    </label>
                    <select wire:model="started" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" placeholder="Jane">
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                    @error("started")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Finished
                    </label>
                    <select wire:model="finished" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" placeholder="Jane">
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                    @error("finished")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Type
                    </label>
                    <select wire:model="fixture_type" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" placeholder="Jane">
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
               </div>
            </form>
    </div>
        <!-- component -->
    <div class="w-full mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Matches Schedule</h2>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto overflow-y-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="text-left w-full">
                        <thead class="bg-black flex text-white w-full">
                            <tr class="flex w-full bg-gray-200 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <th class="p-4 w-1/6">Event</th>
                                <th class="p-4 w-1/6">Home</th>
                                <th class="p-4 w-1/6">HomeScore</th>
                                <th class="p-4 w-1/6">AwayScore</th>
                                <th class="p-4 w-1/6">Away</th>
                                <th class="p-4 w-1/6"></th>
                                <th class="p-4 w-1/6"></th>
                            </tr>
                        </thead>
                    <!-- Remove the nasty inline CSS fixed height on production and replace it with a CSS class — this is just for demonstration purposes! -->
                        <tbody class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full" style="height: 50vh;">
                           @foreach ($fixtures as $fixture)
                           <tr class="flex w-full mb-4">
                            <td class="p-4 w-1/6">
                                <p class="text-gray-900 whitespace-no-wrap text-center">
                                    {{$fixture->event}}
                                </p>
                            </td>
                            <td class="p-4 w-1/6">
                                <div class="flex items-center">
                                    <div class="ml-3">
                                        <p class="text-gray-900 text-center whitespace-no-wrap">
                                            {{$fixture->hometeam->name}}
                                        </p>
                                    </div>
                                </div></td>
                            <td class="p-4 w-1/6">
                                <p class="text-gray-900 whitespace-no-wrap text-center">
                                    {{$fixture->home_team_score}}
                                </p>
                            </td>
                            <td class="p-4 w-1/6">
                                <p class="text-gray-900 whitespace-no-wrap text-center">
                                    {{$fixture->away_team_score}}
                                </p>
                            </td>
                            <td class="p-4 w-1/6">
                                <div class="flex items-center float-right">
                                    <div class="mr-3">
                                        <p class="text-gray-900 whitespace-no-wrap text-right">
                                           {{$fixture->awayteam->name}}
                                        </p>
                                    </div>
                                </div></td>
                                <td class="p-4 w-1/6">
                                    <p class="text-gray-900 whitespace-no-wrap text-center">
                                        {{$fixture->kickoff_time}}
                                    </p>
                                </td>
                                <td class="p-4 w-1/6">
                                    <div class="flex items-center float-right">
                                        <div class="mr-3">
                                               <button wire:click='update({{$fixture}})' class="w-full text-white bg-theme-color pl-4 pr-4 pt-2 pb-2 rounded-md">Edit</button>
                                        </div>
                                    </div></td> 
                        </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="w-full flex flex-col ">
    <div class="w-full flex flex-col justify-between p-5 border-b-2 shadow-md border-blue-400">
        @include('components.messages')
        <h1 class="font-bold text-lg pb-5">Create Fixture</h1>
        <form wire:submit.prevent="submit">
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/5 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Match Day
                    </label>
                    <input wire:model="matchday" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="Jane">
                    @error("matchday")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                 <div class="md:w-1/5 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Home Team
                    </label>
                    <input wire:model="homeTeam" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="Jane">
                    @error("homeTeam")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-1/5 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Away Team
                    </label>
                    <input wire:model="awayTeam" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="Jane">
                    @error("awayTeam")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-1/5 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Time
                    </label>
                    <input wire:model="time" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="date" placeholder="Jane">
                    @error("time")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-1/5 px-3">
                    <button type="submit" class="w-full bg-blue-700 mt-6 hover:bg-blue-dark text-white font-bold py-3 px-4 rounded">
                        Create
                    </button>
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
                                <th class="p-4 w-1/4">Home</th>
                                <th class="p-4 w-1/4">Res</th>
                                <th class="p-4 w-1/4">Res</th>
                                <th class="p-4 w-1/4">Away</th>
                            </tr>
                        </thead>
                    <!-- Remove the nasty inline CSS fixed height on production and replace it with a CSS class — this is just for demonstration purposes! -->
                        <tbody class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full" style="height: 50vh;">
                           @foreach ($fixtures as $item)
                           <tr class="flex w-full mb-4">
                            <td class="p-4 w-1/4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 hidden sm:table-cell">
                                        <img class="w-full h-full rounded-full"
                                            src="https://source.unsplash.com/dKCKiC0BQtU/100x100"
                                            alt="" />
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            Team 1
                                        </p>
                                    </div>
                                </div></td>
                            <td class="p-4 w-1/4">
                                <p class="text-gray-900 whitespace-no-wrap text-center">0</p>
                            </td>
                            <td class="p-4 w-1/4">
                                <p class="text-gray-900 whitespace-no-wrap text-center">0</p>
                            </td>
                            <td class="p-4 w-1/4">
                                <div class="flex items-center float-right">
                                    <div class="mr-3">
                                        <p class="text-gray-900 whitespace-no-wrap text-right">
                                            Team 2
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 w-10 h-10 hidden sm:table-cell">
                                        <img class="w-full h-full rounded-full"
                                            src="https://source.unsplash.com/dKCKiC0BQtU/100x100"
                                            alt="" />
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
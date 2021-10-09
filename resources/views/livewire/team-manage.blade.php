<div class="w-full flex flex-col">
    <div class="w-full flex flex-col p-4 mt-4 text-theme-color bg-white shadow-lg rounded ">
        @include('components.messages')
        <h1 class="font-bold text-lg pb-5 pl-4">Create Teams</h1>
        <form wire:submit.prevent="submit" class="p-4">
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Name
                    </label>
                    <input wire:model="name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="home team">
                    @error("name")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                        Short Name
                    </label>
                    <input wire:model="short_name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="Jane">
                    @error("short_name")
                    <p class="text-red text-xs italic">{{$message}}</p>
                    @enderror
                </div>
                <div class="md:w-1/3 px-3">
                    <button type="submit" class="w-full bg-theme-color mt-6 hover:bg-blue-dark text-white font-bold py-3 px-4 rounded">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- component -->
    <div class="w-full mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>       
                <h2 class="text-2xl font-semibold leading-tight">Team List</h2>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto overflow-y-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="text-left w-full">
                        <thead class="bg-black flex text-white w-full">
                            <tr class="flex w-full bg-gray-200 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <th class="p-4 w-1/3">Id</th>
                                <th class="p-4 w-1/3">Name</th>
                                <th class="p-4 w-1/3">Short Name</th>
                            </tr>
                        </thead>
                        <!-- Remove the nasty inline CSS fixed height on production and replace it with a CSS class — this is just for demonstration purposes! -->
                        <tbody class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full" style="height: 50vh;">
                            @foreach ($teams as $team)
                            <tr class="flex w-full  border-b-2 border-gray-200 bg-white">
                                <td class="p-4 w-1/3">
                                    <p class="text-theme-color font-bold text-lg whitespace-no-wrap text-center">#{{$team->id}}</p>
                                </td>
                                <td class="p-4 w-1/3">
                                    <div class="flex items-center text-center align-middle">
                                        <p class="w-full  text-center text-theme-color font-bold text-lg whitespace-no-wrap">
                                            {{$team->name}}
                                        </p>
                                    </div>
                                </td>
                                <td class="p-4 w-1/3">                                       
                                    <p class="text-center text-theme-color font-bold text-lg whitespace-no-wrap">
                                        {{$team->short_name}}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
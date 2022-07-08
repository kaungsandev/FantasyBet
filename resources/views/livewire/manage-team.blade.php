<div class="flex flex-col w-full">
    <div class="flex flex-col w-full p-4 mt-4 bg-white rounded shadow-lg text-theme-color ">
        @include('components.messages')
        <h1 class="pb-5 pl-4 text-lg font-bold">Create Teams</h1>
        <form wire:submit.prevent="submit" class="p-4">
            <div class="mb-6 -mx-3 md:flex">
                <div class="px-3 mb-6 md:w-1/3 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker"
                        for="grid-first-name">
                        Name
                    </label>
                    <input wire:model="name"
                        class="block w-full px-4 py-3 mb-3 border rounded appearance-none bg-grey-lighter text-grey-darker border-red"
                        id="grid-first-name" type="text" placeholder="home team">
                    @error('name')
                        <p class="text-xs italic text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="px-3 mb-6 md:w-1/3 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker"
                        for="grid-first-name">
                        Short Name
                    </label>
                    <input wire:model="short_name"
                        class="block w-full px-4 py-3 mb-3 border rounded appearance-none bg-grey-lighter text-grey-darker border-red"
                        id="grid-first-name" type="text" placeholder="Jane">
                    @error('short_name')
                        <p class="text-xs italic text-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="px-3 md:w-1/3">
                    <button type="submit"
                        class="w-full px-4 py-3 mt-6 font-bold text-white rounded bg-theme-color hover:bg-blue-dark">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- component -->
    <div class="w-full px-4 mx-auto sm:px-8">
        <div class="py-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold leading-tight">Team List</h2>
                <p wire:loading class="text-blue-400" wire:target='updateTeams'> Updating Teams' data . . .</p>
                <button class="px-4 py-2 text-blue-600 hover:underline hover:text-blue-800 hover:font-bold"
                    wire:click='updateTeams'>Update
                    Teams</button>
            </div>
            <div class="px-4 py-4 -mx-4 overflow-x-auto overflow-y-auto sm:-mx-8 sm:px-8">
                <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                    <table class="w-full text-left">
                        <thead class="flex w-full text-white bg-black">
                            <tr
                                class="flex w-full text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-200">
                                <th class="w-1/3 p-4">Id</th>
                                <th class="w-1/3 p-4">Name</th>
                                <th class="w-1/3 p-4">Short Name</th>
                            </tr>
                        </thead>
                        <!-- Remove the nasty inline CSS fixed height on production and replace it with a CSS class — this is just for demonstration purposes! -->
                        <tbody class="flex flex-col items-center justify-between w-full overflow-y-scroll bg-grey-light"
                            style="height: 50vh;">
                            @foreach ($teams as $team)
                                <tr class="flex w-full bg-white border-b-2 border-gray-200">
                                    <td class="w-1/3 p-4">
                                        <p class="text-lg font-bold text-center whitespace-no-wrap text-theme-color">
                                            #{{ $team->id }}</p>
                                    </td>
                                    <td class="w-1/3 p-4">
                                        <div class="flex items-center text-center align-middle">
                                            <p
                                                class="w-full text-lg font-bold text-center whitespace-no-wrap text-theme-color">
                                                {{ $team->name }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="w-1/3 p-4">
                                        <p class="text-lg font-bold text-center whitespace-no-wrap text-theme-color">
                                            {{ $team->short_name }}
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

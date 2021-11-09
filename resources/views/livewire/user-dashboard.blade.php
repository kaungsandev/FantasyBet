<div class="w-full p-12">
    {{-- User Edit Form --}}
    @include('components.messages')
    @if ($editFormVisible == true)
    <div class="max-w-3xl mx-auto h-auto">
        <div class="flex flex-row justify-between items-center mb-2">
            <h1 class="w-full text-lg font-bold mb-2 h-auto">Update User</h1>
            <button wire:click="resetData" class="w-auto p-2 text-theme-color flex flex-row items-center hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                Back
            </button>
        </div>
        <div class="w-full border-2 rounded-lg border-gray-200 bg-gray-100">
            <form wire:submit.prevent="updateUser" class="m-6 flex flex-col justify-evenly font-medium">
                {{-- Name --}}
                <div class="w-full flex flex-row justify-between items-center  mb-2">
                    <p class="w-full">Name</p>
                    <input wire:model='name' type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('name')
                <p class="w-full text-right text-red-500 text-sm">{{ $message }}</p>
                @enderror
                {{-- Email --}}
                <div class="w-full flex flex-row justify-between items-center  mb-2">
                    <p class="w-full">Email</p>
                    <input wire:model='email' type="text" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                @error('email')
                <p class="w-full text-right text-red-500 text-sm">{{ $message }}</p>
                @enderror
                {{-- Coin --}}
                <div class="w-full flex flex-row justify-between items-center  mb-2">
                    <p class="w-1/2">Coin</p>
                    <div class="mt-1 flex w-auto">           
                        <p class="inline-flex pointer-events-none items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            &euro;
                        </p>                 
                        <input wire:model='coin' type="number" min="0" max="1000" name="coin" id="company-website" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                    </div>
                </div>
                @error('coin')
                <p class="w-full text-right text-red-500 text-sm">{{ $message }}</p>
                @enderror
                {{-- Favourite Team --}}
                <div class="w-full  flex flex-row justify-between items-center mb-2">
                    <p class="w-full">Favourite Team</p>
                    <select wire:model="favouriteTeam" name="favouriteTeam" id="favouriteTeam" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md sm:text-sm border-gray-300">
                        <option value="">Choose Team</option>
                        @foreach ($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('favouriteTeam')
                <p class="w-full text-right text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <div class="w-full flex flex-row justify-end items-center mb-2">
                    <button type="submit" class="w-auto bg-blue-700 p-2 text-white rounded-md hover:cursor hover:bg-blue-400 hover:shadow-md hover:border hover:border-gray-200 border-none">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<!-- component -->
<div class="flex-1 items-center -my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
    <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-theme-color tracking-wider">ID</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-theme-color tracking-wider">Fullname</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-theme-color tracking-wider">Email</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-theme-color tracking-wider">Favourite Team</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-theme-color tracking-wider">Exp</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-theme-color tracking-wider">Coin</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-theme-color tracking-wider">Subscription</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-center text-sm leading-4 text-theme-color tracking-wider">Mail</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                    
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm leading-5 text-theme-color">#{{$user->id}}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                        <div class="text-sm leading-5 text-theme-color">{{$user->name}}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-theme-color border-gray-500 text-sm leading-5">{{$user->email}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-theme-color border-gray-500 text-sm leading-5">
                        @if ($user->fav_team)
                        {{$user->favouriteTeam->name}}
                        @else
                        <p class="text-gray-400">Not Available</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-theme-color border-gray-500 text-sm leading-5">{{$user->rank_no}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-theme-color border-gray-500 text-sm leading-5">
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                            <span class="relative text-xs">&euro;{{$user->coin}}</span>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-theme-color border-gray-500 text-sm leading-5">
                        @if($user->subscription)
                        {{$user->subscription->package->name}}
                        @else
                        <p class="text-gray-400">Not Available</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-theme-color border-gray-500 text-sm leading-5">
                        <div class="flex flex-row justify-evenly items-center">
                            <form action="{{route('subscribe.newsletter')}}" method="POST">
                                @csrf
                                <div class="flex flex-col">
                                    @error('email')
                                    <p class="text-red-400">{{$message}}</p>
                                    @enderror
                                    <input type="hidden" name="email" value="{{$user->email}}">
                                    <button type="submit" class="w-auto p-2 bg-theme-color text-white rounded-md shadow-sm" disabled>
                                        Subscribe to Newsletter
                                    </button>
                                </div>
                            </form>
                            @if ($user->fav_team)
                            <form action="{{route('send.invitation')}}" method="POST">
                                @csrf
                                <div class="flex flex-col">
                                    @error('id')
                                    <p class="text-red-400">{{$message}}</p>
                                    @enderror
                                    <input type="hidden" name="email" value="{{$user->email}}">
                                    <button type="submit" class="w-auto p-2 bg-green-400 text-white rounded-md shadow-sm">
                                        Send Invitation
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b text-theme-color border-gray-500 text-sm leading-5">
                        <button wire:click="editFormToggle({{$user}})" class="px-5 py-2 border-blue-500 border text-theme-color rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">Edit</button>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between mt-4 work-sans">
            <div>
                <p class="text-sm leading-5 text-blue-700">
                    Showing
                    <span class="">1</span>
                    to
                    <span class="font-medium">200</span>
                    of
                    <span class="font-medium">2000</span>
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex shadow-sm">
                    <div	>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <div>
                        <a href="#" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">
                            1
                        </a>
                        <a href="#" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">
                            2
                        </a>
                        <a href="#" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-blue-600 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-tertiary active:text-gray-700 transition ease-in-out duration-150 hover:bg-tertiary">
                            3
                        </a>
                    </div>
                    <div v-if="pagination.current_page < pagination.last_page">
                        <a href="#" class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
@endif
</div>

<div class=" md:w-1/6 md:p-8 md:sticky md:top-0 md:h-screen">
    {{-- For Desktop --}}
    <div class="hidden md:flex md:flex-col">
        {{-- Profile --}}
        <div class="rounded shadow-md p-2 bg-white mb-8">
            @if (auth()->user()->admin ==true)
            <x-nav-link  :active="request()->routeIs('profile')" :href="route('dashboard')">
                <span class="pl-2 w-12 h-12 rounded-lg">
                    <img class="w-12 h-12 rouned-lg shadodw-lg"
                    src="{{asset('img/avatars/'.cache('avatar-'.auth()->user()->id))}}" alt="">
                </span>
                <div class="p-2 pl-4 flex flex-col justify-start text-left">
                    <p>
                        {{auth()->user()->name}}
                    </p>
                    <p class="text-gray-400">
                        {{auth()->user()->rank_title}}
                    </p>
                </div>
            </x-nav-link>
            @else
            <x-nav-link  :active="request()->routeIs('profile')" :href="route('profile')">
                <span class="pl-2 w-12 h-12 rounded-lg">
                    <img class="w-12 h-12 rouned-lg shadodw-lg"
                    src="{{asset('img/avatars/'.cache('avatar-'.auth()->user()->id))}}" alt="">
                </span>
                <div class="p-2 pl-4 flex flex-col justify-start text-left">
                    <p>
                        {{auth()->user()->name}}
                    </p>
                    <p class="text-gray-400">
                        {{auth()->user()->rank_title}}
                    </p>
                </div>
            </x-nav-link>
            @endif
            
        </div>
        {{-- Navigation --}}
        @if ($admin == true)
        <div class="rounded p-2 shadow-md bg-white">
            <x-nav-link  :active="request()->routeIs('dashboard')" :href="route('dashboard')">
                <span class="pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                      </svg>
                </span>
                <span class="p-2 pl-4">Users</span>
            </x-nav-link>
            <x-nav-link  :active="request()->routeIs('dashboard.teams')" :href="route('dashboard.teams')">
                <span class="pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
                <span class="p-2 pl-4">Teams</span>
            </x-nav-link>
            <x-nav-link  :active="request()->routeIs('dashboard.fixtures')" :href="route('dashboard.fixtures')">
                <span class="pl-2">
                    <i class="fas fa-calendar"></i>
                </span>
                <span class="p-2 pl-4">Fixtures</span>
            </x-nav-link>
            <x-nav-link  :active="request()->routeIs('dashboard.packages')" :href="route('dashboard.packages')">
                <span class="pl-2">
                    <i class="fas fa-store"></i>
                </span>
                <span class="p-2 pl-4">Packages</span>
            </x-nav-link>
            <hr>
        </div>
        @else
        <div class="rounded p-2 shadow-md bg-white">
            <x-nav-link  :active="request()->routeIs('home')" :href="route('home')">
                <span class="pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </span>
                <span class="p-2 pl-4">Home</span>
            </x-nav-link>
            <hr>
            <x-nav-link  :active="request()->routeIs('bets.history')" :href="route('bets.history')"    >
                <span class="pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </span>
                <span class="p-2 pl-4">History</span>
            </x-nav-link>
            <hr>
            <x-nav-link  :active="request()->routeIs('fixtures')" :href="route('fixtures')"    >
                <span class="pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </span>
                <span class="p-2 pl-4">Fixture</span>
            </x-nav-link>
            <hr>
            <x-nav-link  :active="request()->routeIs('players')" :href="route('players')"     >
                <span class="pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </span>
                <span class="p-2 pl-4">Players Statistics</span>
            </x-nav-link>
        </div>
        @endif
    </div>
    {{-- Mobile View  Responsive--}}
    <!-- component -->
    <div class="w-full h-auto md:hidden pb-2">
        <!-- <section id="bottom-navigation" class="md:hidden block fixed inset-x-0 bottom-0 z-10 bg-white shadow"> // if shown only tablet/mobile-->
            <div  class="fixed h-16 inset-x-0  bottom-0 z-200 bg-white shadow">
                <div class="flex justify-between">
                    <x-nav-link class="flex items-center justify-center"  :active="request()->routeIs('home')" :href="route('home')">
                        <span class="pb-4 pt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </span>
                    </x-nav-link>
                    <hr>
                    <x-nav-link class="flex items-center justify-center"  :active="request()->routeIs('bets.history')" :href="route('bets.history')"    >
                        <span class="pb-4 pt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </span>
                    </x-nav-link>
                    <hr>
                    <x-nav-link class="flex items-center justify-center"  :active="request()->routeIs('fixtures')" :href="route('fixtures')"    >
                        <span class="pb-4 pt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </span>
                    </x-nav-link>
                    <hr>
                    <x-nav-link class="flex items-center justify-center"  :active="request()->routeIs('players')" :href="route('players')"     >
                        <span class="pb-4 pt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </span>
                    </x-nav-link>
                </div>
            </div>
        </div>
        {{-- Logout --}}
        <div class="hidden md:flex rounded shadow-md bg-white mt-8">
            <form action="{{route('logout')}}" method="POST" class="w-full bg-white rounded">
                @csrf
                <button type="submit" class="rounded text-red-400 flex flex-row justify-center hover:text-white hover:bg-red-400 w-full">
                    <span class="p-2 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </span>
                    <span class="p-2 pl-2">Logout</span>
                </button>
            </form>
        </div>
    </div>
    
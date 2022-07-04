<div class="bg-gray-100 border-r-2 sm:overflow-y-auto md:h-screen md:w-1/4 lg:w-1/3 xl:w-1/4">
    {{-- For Desktop --}}
    <div class="flex-col justify-center hidden h-full space-y-4 md:flex">
        <div class="pl-6">
            <h1 class="font-extrabold uppercase  leading-relax">Fantasy Bet</h1>
        </div>


        {{-- Navigation --}}
        @if ($admin == true)
            <div class="flex flex-col">
                <x-nav-link :active="request()->routeIs('home')" :href="route('home')">
                    <x-slot:icon>
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </x-slot:icon>
                    Back to Home Page
                </x-nav-link>
                <x-nav-link :active="request()->routeIs('dashboard')" :href="route('dashboard')">
                    <x-slot:icon>
                        <i class="fa-solid fa-users"></i>
                    </x-slot:icon>
                    Users
                </x-nav-link>
                <x-nav-link :active="request()->routeIs('dashboard.teams')" :href="route('dashboard.teams')">
                    <x-slot:icon>
                        <i class="fa-solid fa-people-group"></i>
                    </x-slot:icon>
                    Teams
                </x-nav-link>
                <x-nav-link :active="request()->routeIs('dashboard.fixtures')" :href="route('dashboard.fixtures')">
                    <x-slot:icon>
                        <i class="fas fa-calendar"></i>
                    </x-slot:icon>
                    Fixtures
                </x-nav-link>
                <x-nav-link :active="request()->routeIs('dashboard.packages')" :href="route('dashboard.packages')">
                    <x-slot:icon>
                        <i class="fas fa-store"></i>
                    </x-slot:icon>
                    Packages
                </x-nav-link>
                <hr>
            </div>
        @else
            <div class="flex flex-col rounded">
                <x-nav-link :active="request()->routeIs('profile')" :href="route('profile')" id="profile" class="">
                    <x-slot:icon>
                        <i class="fa-regular fa-user"></i>
                    </x-slot:icon>
                    <div class="flex flex-col justify-start text-left">
                        <p class="font-bold">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="hidden text-gray-400 lg:block">
                            {{ auth()->user()->rank_title }}
                        </p>
                        <p class="text-xs font-bold uppercase lg:hidden">&euro;
                            {{ number_format(auth()->user()->coin) }}
                        </p>
                    </div>
                </x-nav-link>
                <x-nav-link :active="request()->routeIs('home')" :href="route('home')">
                    <x-slot:icon>
                        <i class="text-xl fa-solid fa-house"></i>
                    </x-slot:icon>
                    Home
                </x-nav-link>

                <x-nav-link :active="request()->routeIs('bets.history')" :href="route('bets.history')">
                    <x-slot:icon>
                        <i class="fa-regular fa-file-lines"></i>
                    </x-slot:icon>
                    History
                </x-nav-link>

                <x-nav-link :active="request()->routeIs('fixtures')" :href="route('fixtures')">
                    <x-slot:icon>
                        <i class="fa-solid fa-calendar-days"></i>
                    </x-slot:icon>
                    Fixture
                </x-nav-link>

                <x-nav-link :active="request()->routeIs('players')" :href="route('players', ['team_name' => 'Arsenal', 'team' => 1])">
                    <x-slot:icon>
                        <i class="fa-solid fa-chart-simple"></i>
                    </x-slot:icon>
                    Fantasy Players
                </x-nav-link>
            </div>
        @endif
        {{-- Logout
        <div class="hidden md:flex" id="btn-logout">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                    class="inline-flex flex-row items-center justify-center w-full text-sm font-medium leading-5 text-center text-red-400 border-transparent focus:text-white focus:bg-red-300 focus:outline-none focus:shadow-inner hover:shadow-sm">
                    <span class="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </span>
                    <span class="p-6 font-bold text-md lg:text-md">Logout</span>
                </button>
            </form>
        </div> --}}
    </div>
    {{-- Mobile View  Responsive --}}
    <!-- component -->
    <div class="sticky top-0 block w-full h-auto px-4 py-2 pt-4 border-b-2 md:hidden">
        <p class="w-full font-extrabold leading-relaxed text-center">FANTASY BET</p>
    </div>
    <div class="w-full h-auto md:hidden">
        <!-- <section id="bottom-navigation" class="fixed inset-x-0 bottom-0 z-10 block bg-white shadow md:hidden"> // if shown only tablet/mobile-->
        <div class="fixed inset-x-0 bottom-0 h-16 bg-black shadow z-200">
            <div class="flex justify-between">
                <x-nav-link class="flex items-center justify-center" :active="request()->routeIs('home')" :href="route('home')">
                    <span class="pt-4 pb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                </x-nav-link>

                <x-nav-link class="flex items-center justify-center" :active="request()->routeIs('bets.history')" :href="route('bets.history')">
                    <span class="pt-4 pb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </span>
                </x-nav-link>

                <x-nav-link class="flex items-center justify-center" :active="request()->routeIs('fixtures')" :href="route('fixtures')">
                    <span class="pt-4 pb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                </x-nav-link>

                <x-nav-link class="flex items-center justify-center" :active="request()->routeIs('players')" :href="route('players', ['team_name' => 'Arsenal', 'team' => 1])">
                    <span class="pt-4 pb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                </x-nav-link>
            </div>
        </div>
    </div>

</div>

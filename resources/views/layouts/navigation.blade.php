<nav x-data="{ open: false }" class="bg-theme-color border-b border-gray-100 text-white">
    <!-- Primary Navigation Menu -->
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="w-full flex justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-full fill-current text-gray-600" />
                    </a>
                </div>
                
                <!-- Navigation Links -->
                {{-- <div class="hidden md:block mx-auto my-auto flex w-1/2">
                    <div class="relative">
                        <div class="absolute flex border border-transparent left-0 top-0 h-full w-10">
                            <div class="flex items-center justify-center rounded-tl rounded-bl z-10 bg-gray-200 text-gray-600 text-lg h-full w-full">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    
                    <input id="search"
                    name="search"
                    type="text"
                    placeholder="Search"
                    value=""
                    class="text-sm text-theme-color  bg-gray-200 sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                    
                </div>
                </div> --}}
            </div>
        
        <!-- Settings Dropdown -->
        <div class="hidden flex justify-end w-full sm:flex sm:items-center sm:pr-24">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex justify-center text-sm font-medium text-white hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div class="w-full flex">
                            <p class="w-full ">{{auth()->user()->name}}</p>
                        </div>
                        
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>
                
                <x-slot name="content">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        
                        <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
        </div>
    
    <!-- Hamburger -->
    <div class="-mr-2 flex items-center sm:hidden">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
        <button type="submit" class="inline-flex items-center justify-around p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">      
            <span class="pl-2 pr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </span>
        </button>
        </form>
    </div>
</div>
</div>
</nav>

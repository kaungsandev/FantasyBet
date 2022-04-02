<nav x-data="{ open: false }" class="text-slate-500 dark:text-slate-400 border-b border-gray-100 dark:bg-slate-900 bg-neutral-100">
    <!-- Primary Navigation Menu -->
    <div class="w-full px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex justify-between w-full">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                       FANTASY BET
                    </a>
                </div>
            </div>

        <!-- Settings Dropdown -->
        <div class="flex justify-end hidden w-full sm:flex sm:items-center sm:pr-24">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex justify-center text-sm font-medium text-slate-500 dark:text-white transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                        <div class="flex w-full">
                            <p class="w-full ">{{auth()->user()->name}}</p>
                        </div>

                        <div class="ml-1">
                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
    <div class="flex items-center -mr-2 sm:hidden">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
        <button type="submit" class="inline-flex items-center justify-around p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
            <span class="pl-2 pr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </span>
        </button>
        </form>
    </div>
</div>
</div>
</nav>

<div class="w-1/6 p-8 sticky top-0 h-screen">
    {{-- Profile --}}
    <div class="rounded shadow-md p-2 bg-white mb-8">
        <x-nav-link href="{{route('profile')}}" class="w-full text-theme-color bg-white text-center hover:border-purple-700 hover:text-purple-700">
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
    </div>
    {{-- Navigation --}}
    <div class="rounded p-2 shadow-md bg-white">
        <x-nav-link href="{{route('home')}}" class="w-full text-theme-color bg-white text-center  hover:border-purple-700 hover:text-purple-700">
            <span class="pl-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </span>
            <span class="p-2 pl-4">Home</span>
        </x-nav-link>
        <hr>
        <x-nav-link href="{{route('news')}}" class="w-full text-theme-color bg-white text-center  hover:border-purple-700 hover:text-purple-700">
            <span class="pl-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </span>
            <span class="p-2 pl-4">News</span>
        </x-nav-link>
        <hr>
        <x-nav-link href="{{route('news')}}" class="w-full text-theme-color bg-white text-center  hover:border-purple-700 hover:text-purple-700">
            <span class="pl-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                  </svg>
            </span>
            <span class="p-2 pl-4">Notification</span>
        </x-nav-link>
        
    </div>
    {{-- Logout --}}
    <div class="rounded shadow-md bg-white mt-8">
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

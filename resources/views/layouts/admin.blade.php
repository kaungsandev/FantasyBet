<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @livewireStyles
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="w-full flex flex-row justify-between border-b-2 border-blue-200">
            <div class="w-1/6 bg-gray-400">
                <a href="{{route('dashboard.fixtures')}}" class="hover:bg-blue-700 hover:text-white">
                    <p class="w-full text-lg text-center p-5 mx-auto border-white uppercase">Fantasy Bet ADMIN</p>
                </a>
            </div>
           <div class="w-full bg-white flex flex-row-reverse">
            <a href="{{route('dashboard.fixtures')}}" class="hover:bg-blue-700 hover:text-white">
                <p class="w-full text-lg text-center p-5 mx-auto border-b-2 border-white uppercase">{{Auth::user()->name}}</p>
            </a>
           </div>
        </nav>
        <main class="flex flex-row">
            <div class="side-nav bg-gray-400 w-1/6 h-screen flex flex-col border-r-2 border-gray-400">
                
                <a href="{{route('dashboard.fixtures')}}" class="hover:bg-white hover:shadow-lg {{ (request()->routeIs('dashboard.fixtures')) ? 'border-l-4 border-blue-700 bg-white' : '' }}">
                    <p class="w-full text-lg p-5 mx-auto flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>Fixture
                    </p>
                </a>
                <a href="{{route('dashboard.users')}}" class="hover:bg-blue-400 hover:rounded {{ (request()->routeIs('dashboard.users')) ? 'border-l-4 border-blue-700 bg-white' : '' }}">
                    <p class="w-full text-lg p-5 mx-auto flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>User
                    </p>
                </a>
                
                
            </div>
            <div class="main-view flex flex-col w-full">
                @include('components.messages')
                {{ $slot }}
            </div>
        </main>
    </div>
    @livewireScripts
</body>
</html>

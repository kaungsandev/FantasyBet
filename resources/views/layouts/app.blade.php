<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel'). ' | '}}@yield('page_title')</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/all.css')}}">
    @livewireStyles
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        
        <!-- Page Content -->
        <main>
            @include('components.messages')
            <div class="w-full flex flex-col md:flex-row justify-around mx-auto">
                @livewire('left-panel')
                <div class="w-full md:w-1/2 mb-16 md:mb-0">
                    <div class="block sticky top-0 md:hidden w-full rounded shadow-md p-2 bg-white">
                        <x-nav-link href="{{route('billing')}}" class="w-full text-theme-color bg-white text-center hover:border-purple-700 hover:text-purple-700">
                            <div class="w-full p-2 pl-4 flex flex-row justify-end text-right text-lg">
                                <p class="w-full text-left text-theme-color">
                                    &euro;{{number_format(auth()->user()->coin)}}
                                </p>
                                <p class="w-full text-gray-400">
                                    <i class="fas fa-wallet"></i>
                                </p>          
                            </div>
                        </x-nav-link>
                    </div>
                    {{ $slot }}
                </div>
                <div class="hidden md:flex w-1/6">
                    @livewire('right-panel')
                </div>
                
            </div>
        </main>
    </div>
    @livewireScripts
    
</body>
</html>

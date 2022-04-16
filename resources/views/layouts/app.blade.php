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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" async>
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/all.css')}}">
    @livewireStyles
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased ">


        <!-- Page Content -->
        <main class="flex flex-col bg-slate-900">

            <div class="flex flex-col justify-start w-full mx-auto md:flex-row">
                @livewire('left-panel')
                <div class="flex flex-col w-full p-8 mb-16 md:w-3/4 lg:w-full md:mb-0">
                    @include('components.messages')
                    <div class="sticky top-0 block w-full p-2 bg-white rounded shadow-md md:hidden">
                        <x-nav-link href="{{route('billing')}}" class="w-full text-center bg-white text-theme-color hover:border-purple-700 hover:text-purple-700">
                            <div class="flex flex-row justify-end w-full p-2 pl-4 text-lg text-right">
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
                @if (\Route::currentRouteName() != 'players')
                    @livewire('right-panel')

                @endif
            </div>
        </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @yield('scripts')
    @livewireScripts

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') . ' | ' }}@yield('page_title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" async>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="https://kit.fontawesome.com/525732493a.js" crossorigin="anonymous"></script>
    @livewireStyles
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased bg-gray-200">


    <!-- Page Content -->
    <main class="flex flex-col h-screen bg-gray-200">
        <div class="flex flex-col justify-start w-full mx-auto overflow-y-auto md:flex-row no-scrollbar">
            @livewire('left-panel')
            <div class="sticky top-0 block w-full rounded shadow-md shadow-gray-400 md:hidden">
                <x-wallet-card />
            </div>
            <div
                class="flex flex-col justify-start w-full p-2 pb-24 overflow-y-auto lg:p-8 md:w-3/4 lg:w-full md:mb-0 lg:pb-0 no-scrollbar">
                @include('components.messages')

                {{ $slot }}

            </div>
            @if (\Route::currentRouteName() != 'players')
                @livewire('right-panel')
            @endif
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @yield('scripts')
    @livewireScripts

</body>

</html>

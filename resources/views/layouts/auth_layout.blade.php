<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
</head>

<body>
    <div class="container-fluid">
        <div class="row" id="header">
            <header class="masthead">
                
                <div class="container d-flex h-100 align-items-center">
                    @yield('content')
                </div>
            </header>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BoolB&B</title>

        {{-- NPM --}}
        {{-- <link rel="stylesheet" type="text/css" href="maps.css"/> --}}
    
        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('home-fav.ico') }}">
    
        {{-- CDN --}}
        <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.39.0/maps/maps.css'>
    
        {{-- MOBILE --}}
        {{-- <link rel='stylesheet' type='text/css' href='../assets/ui-library/index.css'/> --}}

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    </head>
    <body>
        {{-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif --}}

        <div class="content">
            <div id="root"></div>
        </div>

        <script src=" {{asset('js/app.js')}} "></script>
        <script src=" {{asset('js/front.js')}} "></script>

        {{-- NPM --}}
        {{-- <script src="maps-web.min.js"></script> --}}

        {{-- MOBILE/TABLET --}}
        {{-- <script type='text/javascript' src='../assets/js/mobile-or-tablet.js'></script> --}}

        {{-- CDN --}}
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.39.0/maps/maps-web.min.js"></script>

        {{-- <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.39.0/maps/maps-web.min.js"></script> --}}
        {{-- <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/services/services-web.min.js"></script> --}}

    </body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('home-fav.ico') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg c_navbar bg_navbar" style="height: 10vh;">
            <a class="navbar-brand" href="{{url('/')}}">
                <img class="w-25" src="{{asset('/images/BoolBnb_logo-removebg-preview.png')}}" alt="air-bnb-logo">
            </a>

            <button class="navbar-toggler bg_navbar" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon img_toggler"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link c_navbar" href="{{ route('admin.habitations.index')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link c_navbar" href="{{ route('admin.habitations.index')}}">Posta</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link c_navbar" href="{{ route('admin.habitations.index')}}">Calendario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link c_navbar" href="{{ route('admin.habitations.create')}}">Crea Annuncio</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link c_navbar"  href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link c_navbar" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle c_navbar" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right w-25" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item c_navbar" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>

                    @auth

                    <div>
                        <li class="nav-item dropdown  d-flex flex-row">
                            <a class="nav-link dropdown-toggle c_navbar" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                YourBoolBnb
                            </a>

                            {{-- <ul class="navbar-nav mr-auto">
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li class="m-2">
                                        <a href="{{ route('admin.habitations.index')}}">Approfondimenti</a>
                                    </li>

                                </div>
                            </ul> --}}
                        </li>
                    </div>
                    @endauth 
                </div>
            </div>
        </nav>
        

    <main class="{{Request::route()->getName() == 'login' || Request::route()->getName() == 'register' || Request::route()->getName() == 'admin.sponsor' || Request::route()->getName() == 'admin.pay' ? 'bg_gradient h-100' : ''}}">

        @yield('content')

    </main>

    <div class="container-fluid bg-color position-relative py-3">
        <div class="row p-4">

            <ul class="col-12 col-md-4 mb-3 mb-lg-1 d-flex flex-column align-items-center footer">
                <li class="font-weight">
                    Assistenza
                </li>
                <li>
                    Centro Assistenza 
                </li>
                <li>
                    AirCover
                </li>
                <li>
                    Informazioni di sicurezza 
                </li>
                <li>
                    Accessibilit&agrave; per tutti
                </li>
                <li>
                    Opzioni di cancellazione
                </li>
                <li>
                    Emergenza COVID-19
                </li>
                <li>
                    Segnala problemi nel quartiere
                </li>
            </ul>

            <ul class="col-12 col-md-4 mb-3 mb-lg-1 d-flex flex-column align-items-center footer">

                <li class="font-weight">
                    Ospitare
                </li>
                <li>
                    Prova a ospitare
                </li>
                <li>
                    AirCover per gli host
                </li>
                <li>
                    Risorse per host 
                </li>
                <li>
                    Forum della community
                </li>
                <li>
                    Ospitare responsabilmente 
                </li>
            </ul>

            <ul class="col-12 col-md-4 mb-mb-lg-1 d-flex flex-column align-items-center footer">

                <li class="font-weight">
                    BoolB&B
                </li>
                <li>
                    Nuove funzionalit&agrave;
                </li>
                <li>
                    Lettera dai nostri fondatori  
                </li>
                <li>
                    Opportunit&agrave; di lavoro 
                </li>
                <li>
                    Iscrizion Newsletter
                </li>
                <li>
                    Lista Investitori
                </li>
                <li>
                    Gift card  
                </li>
            </ul>


            <!-- wave
                    <div class="wave">
                        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                    </div>
            -->
        
        </div>

        <div class="text-center mb-5">
            <h3 class="pb-3">Trovaci sui nostri social!</h3>
            <img class="icon mx-md-4 ml-2" src="/img/icon-social/facebook.png" alt="facebook icon link">
            <img class="icon mx-md-4 ml-2" src="/img/icon-social/instagram.png" alt="instagram icon link">
            <img class="icon mx-md-4 ml-2" src="/img/icon-social/twitter.png" alt="twitter icon link">
            <img class="icon mx-md-4 ml-2" src="/img/icon-social/youtube.png" alt="youtube icon link">
            <img class="icon mx-md-4 ml-2" src="/img/icon-social/whatsapp.png" alt="whatsup icon link">
        </div>

        <div class="position-absolute scrollTop">
            <button @click="scrollToTop" type="button" class="btn btn-outline-dark shadow-none"><strong>&#8892;</strong></button>
        </div>


        <div class="text-center">
            <p>&copy;Copyright 2022-2022 | Theme by Boolean | All Rights Reserved | Powered by Booleans</p>
        </div>
    </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>

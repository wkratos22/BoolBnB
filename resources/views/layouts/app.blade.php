<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg c_navbar bg_navbar">
            <a class="navbar-brand" href="{{url('/')}}">
                <img class="w-25" src="{{asset('/images/BoolBnb_logo-removebg-preview.png')}}" alt="air-bnb-logo">
            </a>

            <button class="navbar-toggler bg_navbar" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon bg_navbar"></span>
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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
        {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <div>
                <a class="navbar-brand" href="{{url('/')}}">
        <img class="w-25" src="{{asset('/images/BoolBnb_logo-removebg-preview.png')}}" alt="air-bnb-logo">
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

            <li class="m-2 nav-item">
                <a class="nav-link" href="{{ route('admin.habitations.index')}}">Dashboard</a>
            </li>
            <li class="m-2 nav-item">
                <a class="nav-link" href="{{ route('admin.habitations.index')}}">Posta</a>
            </li>
            <li class="m-2 nav-item">
                <a class="nav-link" href="{{ route('admin.habitations.index')}}">Calendario</a>
            </li>
            <li class="m-2 nav-item">
                <div class="text-center">
                    <a class="nav-link" href="{{ route('admin.habitations.create')}}">Crea Annuncio</a>
                </div>
            </li>
        </ul>
    </div> --}}

    {{-- <div class="d-flex">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </li>
    @if (Route::has('register'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
    </li>
    @endif
    @else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                YourBoolBnb
            </a>

            <ul class="navbar-nav mr-auto">
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li class="m-2">
                        <a href="{{ route('admin.habitations.index')}}">Approfondimenti</a>
                    </li>

                </div>
            </ul>
        </li>
    </div>
    @endauth
    </div> --}}
    {{-- </nav> --}}

    <main
        class="{{Request::route()->getName() == 'admin.habitations.create' || Request::route()->getName() == 'admin.habitations.edit' ? 'bg_gradient' : ''}}">

        @yield('content')

    </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>

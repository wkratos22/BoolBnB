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
        <nav class="d-flex justify-content-between navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div>
                <a href="{{url('/')}}">
                    <img class="w-25" src="{{asset('/images/BoolBnb_logo-removebg-preview.png')}}" alt="air-bnb-logo">
                </a>
            </div>

            <div>
                <ul class="navbar-nav mr-auto">

                    <li class="m-2">
                        <a href="{{ route('admin.habitations.index')}}">Dashboard</a>
                    </li>
                    <li class="m-2">
                        <a href="{{ route('admin.habitations.index')}}">Posta</a>
                    </li>
                    <li class="m-2">
                        <a href="{{ route('admin.habitations.index')}}">Calendario</a>
                    </li>
                    <li class="m-2">
                        <div class="text-center">
                            <a class="" href="{{ route('admin.habitations.create')}}">Crea Annuncio</a>
                        </div>
                    </li>
                </ul>
            </div>

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
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                </div>
        </nav>

        <main class="{{Request::route()->getName() == 'admin.habitations.create' || Request::route()->getName() == 'admin.habitations.edit' ? 'bg_gradient' : ''}}">
            <div>
                @yield('content')
            </div>
        </main>
    </div>

        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>

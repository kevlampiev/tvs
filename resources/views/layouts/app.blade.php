<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="SHORTCUT ICON" href="{{asset('fehu-runa.png')}}" type="image/x-icon">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield("styles")
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('fehu-runa.png')}}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @if (Auth::user())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Состояние расчетов
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="{{route('user.allSettlements')}}">Состояние расчетов по
                                    компаниям</a>
                                <a class="nav-link" href="{{route('user.allSettlements2')}}">Состояние расчетов по
                                    контрагентам</a>
                                <div class="dropdown-divider"></div>
                                <a class="nav-link" href="{{route('user.nearestPayments')}}">Предстоящие платежи</a>
                            </div>
                        </li>
                    @endif

                    @if (Auth::user()&&(Auth::user()->role!='user'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.main')}}">Панель управления</a>
                        </li>
                    @endif


                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @include('layouts.components.user-data-group')
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="container-fluid p-3">
            @yield('content')
        </div>
    </main>
</div>

@yield('scripts')
</body>
</html>

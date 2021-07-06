<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">
    @yield("styles")
    <script src="{{ mix('js/app.js') }}"></script>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">На главную <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.vehicles')}}">Список техники</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.agreements')}}">Договоры</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Справочники
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('admin.companies')}}">Компании группы</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('admin.vehicleTypes')}}">Типы техники</a>
                    <a class="dropdown-item" href="{{route('admin.manufacturers')}}">Производители</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('admin.agrTypes')}}">Типы договоров</a>
                    <a class="dropdown-item" href="{{route('admin.counterparties')}}">Контрагенты</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('admin.insuranceCompanies')}}">Страховые компании</a>
                    @if (Auth::user()->role=='admin')
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('admin.users')}}">Пользователи</a>
                    @endif
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="GET">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchStr"
                   value="{{isset($filter)?$filter:''}}">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>

    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

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
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        Выйти из системы
                    </a>
                </div>
            </li>
        @endguest
    </ul>
</nav>

<div class="container-fluid m-3">

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

    @yield('content')
</div>


@yield('scripts')
</body>
</html>


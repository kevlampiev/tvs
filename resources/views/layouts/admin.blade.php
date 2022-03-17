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

</head>
<body>




<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.main') }}">
            <img src="{{asset('fehu-runa.png')}}" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Кузбасс-Майнинг
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin.vehicles')}}">Техника</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.agreements')}}">Договоры</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.insurances')}}">Страховки</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Проекты/задачи
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('admin.projects')}}">Проекты</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('admin.userTasks', ['user' => auth()->user()])}}">
                                Мои задачи
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Справочники
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('admin.companies')}}">Компании группы</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('admin.vehicleTypes')}}">Типы техники</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.manufacturers')}}">Производители</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('admin.agrTypes')}}">Типы договоров</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.counterparties')}}">Контрагенты</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('admin.insuranceCompanies')}}">Страховые компании</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.insuranceTypes')}}">Тип страховок</a></li>
                        @if (Auth::user()->role=='admin')
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{route('admin.users')}}">Пользователи</a></li>
                        @endif

                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Экспорт/импорт
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('admin.loadBankStatement')}}">Загрузка выписки</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('admin.exportVehicles')}}">Выгрузка списка техники</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.exportAgreementPayments')}}">Выгрузка платежей по договорам</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.exportRealPayments')}}">Выгрузка реальных платежей</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.exportInsurances')}}">Выгрузка страховок</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.exportAgreements')}}">Выгрузка списка договоров</a></li>

                    </ul>
                </li>
                <li class="nav-item ml-lg-5 font-italic small">
                    <a class="nav-link" href="{{route('home')}}">Раздел отчетов <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="d-flex" method="GET" action="{{route('admin.globalSearch')}}">
                <input class="form-control me-2" type="search" placeholder="глобальный поиск ..." aria-label="Search"
                name="globalSearch" >
                <button class="btn btn-outline-info" type="submit">Искать</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @include('layouts.components.user-data-group')
            </ul>

        </div>
    </div>
</nav>


<div class="container-fluid m-3" id="app">

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

        <div id="app">
            @yield('content')
        </div>

</div>
<script src="{{asset('js/app.js')}}" ></script>
@yield('scripts')

{{--Всплывающее диалоговое окно правом нижнем углу экрана--}}
@include('Admin.dashboard.toasts')

</body>
</html>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" type="text/css">

    @yield("styles")

</head>
<body>




<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.main') }}">
            <img src="{{asset('fehu-runa.png')}}" alt="" width="30" height="24" class="d-inline-block align-text-top">
            {{config('app.name')}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active" href="{{route('admin.vehicles')}}">Техника</a>--}}
{{--                </li>--}}

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#"
                       id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Техника
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('admin.vehicles')}}">Список техники</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item disabled" href="#">Отчет по состоянию техники</a></li>
                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#"
                       id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Договоры/расчеты
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item"  href="{{route('admin.agreements')}}">Договоры</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item"   href="{{route('admin.allSettlements')}}">Состояние расчетов по компаниям</a></li>
                        <li><a class="dropdown-item"   href="{{route('admin.allSettlements2')}}">Состояние расчетов по контрагентам</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item"   href="{{route('admin.nearestPayments')}}">Предстоящие платежи</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#"
                       id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Страховки
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item"  href="{{route('admin.insurances')}}">Перечень страховок</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.insuredVehicles')}}">Отчет по страхованию техники </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('admin.actualInsurancesByInsCompanies')}}">Действующие
                            страховки по страховым компаниям</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.actualInsurancesByInsTypes')}}">Действующие
                            страховки по категориям</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{route('admin.insurancesToRenewal')}}">Страховки,
                            требующие срочного оформления</a></li>

                    </ul>
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
                        <li><a class="dropdown-item" href="{{route('admin.locations')}}">Местонахождения техники</a></li>
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
        <div class="d-none d-lg-block pt-2 pl-lg-4">
            <a class="btn btn-outline-secondary mr-1 border-0" href="{{route('admin.vehicles')}}">
                <i class="bi bi-truck"></i> Техника
            </a>

            <a class="btn btn-outline-secondary mr-1 border-0" href="{{route('admin.agreements')}}">
                <i class="bi bi-files"></i> Договоры
            </a>

            <a class="btn btn-outline-secondary mr-1 border-0"
               href="{{route('admin.userTasks', ['user' => auth()->user()])}}">
                <i class="bi bi-list-task"></i> Мои задачи
            </a>
            <a class="btn btn-outline-secondary mr-1 border-0"
               href="{{route('admin.counterparties')}}">
                <i class="bi bi-people"></i> Контрагенты
            </a>
        </div>


<div class="container-fluid m-3" id="app">

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @if(count(auth()->user()->unreadNotifications)>0)
        <div class="alert alert-info">
            <a href="{{route('admin.main')}}">&#9993; Для Вас есть новые уведомления </a>
            <span class="badge bg-info">{{count(auth()->user()->unreadNotifications)}}</span>
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


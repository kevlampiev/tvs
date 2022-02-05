@extends('layouts.admin')

@section('title')
    Администратор|Карточка договора
@endsection

@section('content')
    <h3>Карточка контрагента № {{$counterparty->name}}</h3>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#main-info">Основная информация</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#agreements">Договоры</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#staff">Сотрудники</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tasks">Задачи</a>
        </li>
    </ul>


    <div class="tab-content">
        <div class="tab-pane fade show active" id="main-info">
            <h4>Основные данные</h4>
{{--            @include('Admin.agreement-summary.agreement-main')--}}
        </div>
>
    </div>


    <div class="tab-content">
        <div class="tab-pane fade show active" id="agreements">
            <h4>Заключенные договоры</h4>
{{--            @include('Admin.agreement-summary.agreement-main')--}}
        </div>
>
    </div>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="staff">
            <h4>Заключенные договоры</h4>
{{--            @include('Admin.agreement-summary.agreement-main')--}}
        </div>
>
    </div>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="tasks">
            <h4>Заключенные договоры</h4>
{{--            @include('Admin.agreement-summary.agreement-main')--}}
        </div>
>
    </div>

@endsection

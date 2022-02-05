@extends('layouts.admin')

@section('title')
    Администратор|Карточка договора
@endsection

@section('content')
    <h3>Карточка контрагента {{$counterparty->name}}</h3>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#main-info">Основная информация</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#agreements">Договоры с контрагентом</a>
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
            @include('Admin.counterparties.components.common-info')
        </div>

        <div class="tab-pane fade" id="agreements">
            <h4>Договора, заключенные с контрагентом</h4>
            @include('Admin.counterparties.components.agreements-table')
        </div>

        <div class="tab-pane fade" id="staff">
            <h4>Сотрудники контрагента</h4>
{{--            @include('Admin.vehicle-summary.vehicle-files')--}}
        </div>

        <div class="tab-pane fade" id="tasks">
            <h4>Задачи, связанные с контрагентом</h4>
            @include('Admin.counterparties.components.tasks-table')
        </div>


    </div>
@endsection

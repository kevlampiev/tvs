@extends('layouts.admin')

@section('title')
    Администратор|Просмотр информации о технике
@endsection

@section('content')
    <h3> Информация по единице техники {{$vehicle->name}}</h3>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#main-info">Основная информация</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#agreements">Договоры покупки</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#insurance_policies">Страховки</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#collaterals">Залоги</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="main-info">
            <h4>Основные данные</h4>
            @include('Admin.vehicle-comps.vehicle-main')
        </div>

        <div class="tab-pane fade" id="insurance_policies">
            <h4>Страховые полисы</h4>
            <div class="row">
{{--                <a class="btn btn-outline-info"--}}
{{--                   href="{{route('admin.attachAgreement', ['vehicle'=>$vehicle])}}">Привязать договор</a>--}}
            </div>
            @include('Admin.vehicle-comps.insurances-table')
        </div>

        <div class="tab-pane fade" id="agreements">
            <h4>Договоры покупки техники</h4>
            <div class="row">
                <a class="btn btn-outline-info"
                   href="{{route('admin.attachAgreement', ['vehicle'=>$vehicle])}}">Привязать договор</a>
            </div>
            @include('Admin.vehicle-comps.agreements-table')
        </div>
        <div class="tab-pane fade" id="collaterals">
            Залоги
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        function autoSelectPage() {
            let urlArr = document.location.pathname.split('/')
            if (urlArr.length === 6) {
                let tabName = '[href="#' + urlArr[5] + '"'
                $(tabName).tab('show')
            }
        }

        document.addEventListener("DOMContentLoaded", autoSelectPage);
    </script>

@endsection


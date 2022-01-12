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
            <a class="nav-link" data-toggle="tab" href="#files">Файлы/Документы</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#insurance_policies">Страховки</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#collaterals">Залоги</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#notes">Заметки</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#photos">Фотографии</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="main-info">
            <h4>Основные данные</h4>
            @include('Admin.vehicle-summary.vehicle-main')
        </div>

        <div class="tab-pane fade" id="insurance_policies">
            <h4>Страховые полисы</h4>
            @include('Admin.vehicle-summary.insurances-table')
        </div>

        <div class="tab-pane fade" id="files">
            <h4>Связанные файлы</h4>
            @include('Admin.vehicle-summary.vehicle-files')
        </div>

        <div class="tab-pane fade" id="agreements">
            <h4>Договоры покупки техники</h4>

            @include('Admin.vehicle-summary.agreements-table')
        </div>
        <div class="tab-pane fade" id="collaterals">
            Залоги
        </div>
        <div class="tab-pane fade" id="notes">
            @include('Admin.vehicle-summary.vehicle-notes')
        </div>
                <div class="tab-pane fade" id="photos">
            @include('Admin.vehicle-summary.vehicle-photos')
        </div>

    </div>

@endsection

@section('styles')
    <style>
        .notes-container {
            overflow-y: scroll;
        }

        .file-info-container {
            display: flex;
            flex-wrap: wrap;
        }

        .clr-gray {
            background-color: #f5f5f5;
        }
    </style>

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


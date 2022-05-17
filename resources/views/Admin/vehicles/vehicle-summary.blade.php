@extends('layouts.admin')

@section('title')
    Администратор|Просмотр информации о технике
@endsection

@section('content')
    <h3> Информация по единице техники {{$vehicle->name}}</h3>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active"
                    id="main-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#main"
                    type="button"
                    role="tab"
                    aria-controls="main"
                    aria-selected="true">
                Главная
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="agrements-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#agreements"
                    type="button"
                    role="tab"
                    aria-controls="agreements"
                    aria-selected="false">
                Договоры
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="insurances_policies-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#insurances_policies"
                    type="button"
                    role="tab"
                    aria-controls="insurances_policies"
                    aria-selected="false">
                Страховые полисы
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="files-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#files"
                    type="button"
                    role="tab"
                    aria-controls="files"
                    aria-selected="false">
                Связанные файлы
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="collaterals-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#collaterals"
                    type="button"
                    role="tab"
                    aria-controls="collaterals"
                    aria-selected="false">
                Залоги
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="tasks-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#tasks"
                    type="button"
                    role="tab"
                    aria-controls="tasks"
                    aria-selected="false">
                Задачи
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="notes-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#notes"
                    type="button"
                    role="tab"
                    aria-controls="notes"
                    aria-selected="false">
                Заметки
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="photos-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#photos"
                    type="button"
                    role="tab"
                    aria-controls="photos"
                    aria-selected="false">
                Фотографии
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link"
                    id="incidents-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#incidents"
                    type="button"
                    role="tab"
                    aria-controls="incidents"
                    aria-selected="false">
                Инциденты/происшествия
            </button>
        </li>

    </ul>

{{--    Ниже идет содержитмое вкладок--}}

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
            <h4>Основные данные</h4>
            @include('Admin.vehicles.vehicle-summary.vehicle-main')
        </div>
        <div class="tab-pane fade"  id="agreements" role="tabpanel" aria-labelledby="agrements-tab">
            <h4>Договоры покупки техники</h4>
            @include('Admin.vehicles.vehicle-summary.agreements-table')
        </div>
        <div class="tab-pane fade" id="insurances_policies" role="tabpanel" aria-labelledby="insurances_policies-tab">
            <h4>Страховые полисы</h4>
            @include('Admin.vehicles.vehicle-summary.insurances-table')
        </div>
        <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
            <h4>Связанные документы</h4>
            @include('Admin.vehicles.vehicle-summary.vehicle-files')
        </div>
        <div class="tab-pane fade" id="collaterals" role="tabpanel" aria-labelledby="collaterals-tab">
            <h4>Договора по которым техника передана в залог</h4>
            @include('Admin.vehicles.vehicle-summary.vehicle-deposits', ['deposits' => $vehicle->deposits])
        </div>

        <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
            <h4>Задачи, связанные с техникой</h4>
            @include('Admin.vehicles.vehicle-summary.vehicle-tasks')
        </div>
        <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
            <h4>Заметки по едицине техники</h4>
            @include('Admin.vehicles.vehicle-summary.vehicle-notes')
        </div>
        <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
            <h4>Фотографии техники</h4>
            @include('Admin.vehicles.vehicle-summary.vehicle-photos')
        </div>

        <div class="tab-pane fade" id="incidents" role="tabpanel" aria-labelledby="incidents-tab">
            <h4>Инциденты/аварии/происшествия</h4>
            @include('Admin.vehicles.vehicle-summary.vehicle-incidents')
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
                let tabName = '[data-bs-target="#' + urlArr[5] + '"'
                $(tabName).tab('show')
            }
        }

        document.addEventListener("DOMContentLoaded", autoSelectPage);
    </script>

@endsection


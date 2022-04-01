@extends('layouts.admin')

@section('title')
    Администратор| Карточка компании
@endsection


@section('content')
    <h3>Карточка компании {{$company->name}}</h3>


    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active"
                    id="main-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#main"
                    type="button"
                    role="tab"
                    aria-controls="main"
                    aria-selected="true">
                Основная информация
            </button>
            <button class="nav-link"
                    id="poas-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#poas"
                    type="button"
                    role="tab"
                    aria-controls="poas"
                    aria-selected="true">
                Выданные доверенности
            </button>
        </div>
    </nav>


    <div class="tab-content p-2" id="nav-tabContent">
        <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
            <h4>Основные данные</h4>
            @include('Admin.companies.components.common-info')
        </div>
        <div class="tab-pane fade" id="poas" role="tabpanel" aria-labelledby="poas-tab">
            <h4>Выданные доверенности</h4>
            <div class="row m-1">
                <div class="col-md-12">
                    @include('Admin.companies.components.poas-table')
                </div>
            </div>
        </div>
    </div>


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

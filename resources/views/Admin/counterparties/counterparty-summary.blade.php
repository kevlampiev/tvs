@extends('layouts.admin')

@section('title')
    Администратор|Карточка договора
@endsection

@section('content')
    <h3>Карточка контрагента {{$counterparty->name}}</h3>

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
                Договоры
            </button>
            <button class="nav-link"
                    id="agreements-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#agreements"
                    type="button"
                    role="tab"
                    aria-controls="agreements"
                    aria-selected="true">
                Заключенные договоры
            </button>
            <button class="nav-link"
                    id="staff-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#staff"
                    type="button"
                    role="tab"
                    aria-controls="staff"
                    aria-selected="true">
                Сотрудники контрагента
            </button>
            <button class="nav-link"
                    id="tasks-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#tasks"
                    type="button"
                    role="tab"
                    aria-controls="tasks"
                    aria-selected="true">
                Задачи
            </button>
        </div>
    </nav>


    <div class="tab-content p-2" id="nav-tabContent">
        <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
            <h4>Основные данные</h4>
            @include('Admin.counterparties.components.common-info')
        </div>
        <div class="tab-pane fade" id="agreements" role="tabpanel" aria-labelledby="agreements-tab">
            <h4>Договора, заключенные с контрагентом</h4>
            @include('Admin.counterparties.components.agreements-table')
        </div>

        <div class="tab-pane fade" id="staff" role="tabpanel" aria-labelledby="staff-tab">
            <h4>Сотрудники контрагента</h4>
            @include('Admin.counterparties.components.employee-table')
        </div>

        <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
            <h4>Задачи, связанные с контрагентом</h4>
            @include('Admin.counterparties.components.tasks-table')
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

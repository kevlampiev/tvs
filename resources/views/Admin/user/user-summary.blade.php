@extends('layouts.admin')

@section('title')
    Администратор|Карточка пользователя
@endsection


@section('content')
    <h3>Карточка Пользователя {{$user->name}}</h3>


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
                    id="tasks-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#tasks"
                    type="button"
                    role="tab"
                    aria-controls="tasks"
                    aria-selected="true">
                Задачи пользователя
            </button>
        </div>
    </nav>


    <div class="tab-content p-2" id="nav-tabContent">
        <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
            <h4>Основные данные</h4>
            @include('Admin.user.components.user-main')
        </div>
        <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
            <h4>Задачи</h4>
            <div class="row m-1">
                <div class="col-md-12">
                    @include('Admin.user.components.user-tasks')
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

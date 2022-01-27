@extends('layouts.admin')

@section('title')
    Администратор|Главная
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 p-5">
            <h3> Повестка дня</h3>

{{--            <h4 class="text-danger">  Просроченные задачи <span class="badge bg-danger">{{count($overdueTasks)}}</span> </h4>--}}
{{--            @include('Admin.dashboard.tasks-list',['tasks'=>$overdueTasks])--}}
{{--            <h4 class="text-warning">  Задачи на сегодня <span class="badge bg-warning">{{count($todaysTasks)}}</h4>--}}
{{--            @include('Admin.dashboard.tasks-list',['tasks'=>$todaysTasks])--}}
{{--            <h4>  Будущие задачи <span class="badge bg-secondary">{{count($futureTasks)}}</h4>--}}
{{--            @include('Admin.dashboard.tasks-list',['tasks'=>$futureTasks])--}}


            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button text-danger" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                             Просроченные задачи <span class="badge bg-danger ml-1">{{count($overdueTasks)}}</span>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            @include('Admin.dashboard.tasks-list',['tasks'=>$overdueTasks])
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed text-warning" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Задачи на сегодня <span class="badge bg-warning ml-1">{{count($todaysTasks)}}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            @include('Admin.dashboard.tasks-list',['tasks'=>$todaysTasks])
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            Будущие задачи <span class="badge bg-secondary ml-1">{{count($futureTasks)}}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            @include('Admin.dashboard.tasks-list',['tasks'=>$futureTasks])
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">

        </div>
    </div>
@endsection

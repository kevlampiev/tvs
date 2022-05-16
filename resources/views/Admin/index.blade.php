@extends('layouts.admin')

@section('title')
    Администратор|Главная
@endsection


@section('content')
    {{--    @dd($data)--}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    <h4 class="m-auto">Предстоящие платежи ({{$upcomingPaymentsPeriod}} дн.) </h4>
                    @include('Admin.dashboard.upcoming-payments');
                </div>

                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    <h4 class="m-auto">Ближайшие задачи ({{$upcomingInsurancesPeriod}} дн.) </h4>
                    @include('Admin.dashboard.upcoming-events-list')
                </div>

            </div>


            <div class="col-md-6">

                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlockLong">
                    <h4 class="m-auto">Последние события </h4>
                    @include('Admin.dashboard.lastEvents')
                </div>
            </div>

        </div>
    </div>
@endsection

@section('styles')
    <style>
        .dashBoardBlock {
            height: 350px;
            overflow-y: hidden;
            margin: 10px;
        }

        .dashBoardBlockLong {
            overflow-y: hidden;
            margin: 10px;
        }

        .vehiclesToBeInsured {
            height: 235px;
            margin: 15px;
            padding: 15px;
            column-count: 3;
            column-gap: 15px;
            outline: lightgray 1px solid;
            overflow: scroll;
        }

        .note-block {
            margin: 10px;
            padding: 10px;
            outline: 1px solid #ddd;
        }

        .bottom-line {
            display: flex;
            justify-content: space-between;
        }

    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        let element = document.getElementById('chart');

        function drawChart () {
            let data = google.visualization.arrayToDataTable({!! $data !!});

            let options = {
                width: element.parentElement.clientWidth - 40,
                height: element.parentElement.clientHeight - 100,
                isStacked: true,
                colors: [ '#FAEBCC', '#b7eaf3',],
                legend: { position: 'bottom', maxLines: 3 },
            };

            let chart = new google.visualization.BarChart(element);
            chart.draw(data, options);
        }

        google.charts.load('current', { packages: ['corechart', 'bar'] });
        google.charts.setOnLoadCallback(drawChart);
    </script>

@endsection


{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="shadow  p-5">--}}
{{--            <h3> Повестка дня</h3>--}}


{{--            <div class="accordion" id="accordionPanelsStayOpenExample">--}}
{{--                <div class="accordion-item">--}}
{{--                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">--}}
{{--                        <button class="accordion-button text-danger" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">--}}
{{--                             Просроченные задачи <span class="badge bg-danger ml-1">{{count($overdueTasks)}}</span>--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">--}}
{{--                        <div class="accordion-body">--}}
{{--                            @include('Admin.dashboard.tasks-list',['tasks'=>$overdueTasks])--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="accordion-item">--}}
{{--                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">--}}
{{--                        <button class="accordion-button collapsed text-warning" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">--}}
{{--                            Задачи на сегодня <span class="badge bg-warning ml-1">{{count($todaysTasks)}}--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">--}}
{{--                        <div class="accordion-body">--}}
{{--                            @include('Admin.dashboard.tasks-list',['tasks'=>$todaysTasks])--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="accordion-item">--}}
{{--                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">--}}
{{--                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">--}}
{{--                            Будущие задачи <span class="badge bg-secondary ml-1">{{count($futureTasks)}}</span>--}}
{{--                        </button>--}}
{{--                    </h2>--}}
{{--                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">--}}
{{--                        <div class="accordion-body">--}}
{{--                            @include('Admin.dashboard.tasks-list',['tasks'=>$futureTasks])--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            </div>--}}
{{--        </div>--}}


{{--        <div class="col-md-6 ">--}}
{{--            <div class="shadow p-5">--}}
{{--                <h3> Последние сообщения </h3>--}}
{{--                <div class="m-4">--}}
{{--                    <ul class="list-group list-group-flush">--}}
{{--                        @foreach($lastMessages as $key=>$message)--}}
{{--                            <li class="list-group-item">--}}
{{--                                <a class="text-secondary"--}}
{{--                                    @if($message->task_id)--}}
{{--                                        href="{{route('admin.taskCard', [$message->task_id])}}"--}}
{{--                                   @elseif($message->agreement_id)--}}
{{--                                        href="{{route('admin.agreementSummary', [$message->agreement_id])}}"--}}
{{--                                   @elseif($message->vehicle_id)--}}
{{--                                        href="{{route('admin.vehicleSummary', [$message->vehicle_id])}}"--}}
{{--                                   @else--}}

{{--                                    @endif--}}
{{--                                >--}}
{{--                                    {!! strip_tags($message->description) !!}--}}
{{--                                </a>--}}
{{--                                <span class="small text-secondary"> {{\Carbon\Carbon::parse($message->created_at)->format('d.m.Y')}}--}}
{{--                                    автор: {{$message->user->name}}</span>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}


{{--            </div>--}}

{{--            <div class="shadow p-5">--}}
{{--                <h3> Нарушение целостности базы данных </h3>--}}
{{--                <div class="m-4">--}}
{{--                    Техника с некорректной ценой/датой приобретения <span class="badge bg-danger     ml-1">{{$vehiclesWithoutProperPrices}}</span>--}}
{{--                </div>--}}

{{--                <div class="m-4">--}}
{{--                    Техника без страховки <span class="badge bg-danger     ml-1">{{$uninsuredVehiclesCount}}</span>--}}
{{--                </div>--}}

{{--                <div class="m-4">--}}
{{--                    Техника без ПТС/ПСМ <span class="badge bg-danger     ml-1">{{$vehiclesWithoutPassport}}</span>--}}
{{--                </div>--}}

{{--                <div class="m-4">--}}
{{--                    Техника без договоров <span class="badge bg-danger     ml-1">{{$noAgrVehicles}}</span>--}}
{{--                </div>--}}

{{--                <div class="m-4">--}}
{{--                    Техника с повторяющимся VIN <span class="badge bg-danger     ml-1">{{$doubleVIN}}</span>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

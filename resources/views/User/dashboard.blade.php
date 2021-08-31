@extends('layouts.app')


@section('content')
    {{--    @dd($data)--}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    <h4 class="m-auto">Предстоящие платежи ({{$upcomingPaymentsPeriod}} дн.) </h4>
                    @include('User.dashboard.upcoming-payments');
                </div>

                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    <h4 class="m-auto">Ближайшие задачи ({{$upcomingInsurancesPeriod}} дн.) </h4>
                    @include('User.dashboard.upcoming-events-list')
                </div>

            </div>


            <div class="col-md-6">

                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlockLong">
                    <h4 class="m-auto">Последние события </h4>
                    @include('User.dashboard.lastEvents')
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

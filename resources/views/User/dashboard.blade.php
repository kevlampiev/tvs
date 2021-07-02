@extends('layouts.app')


@section('content')
    {{--    @dd($data)--}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    <h4 class="m-auto">Предстоящие платежи</h4>
                    <div id="chart" ></div>

                    <div class="text-right mt-md-3">
                        <a href="{{route('user.nearestPayments')}}">Подробнее...</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    <h4 class="m-auto">Страховки к оформлению</h4>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda consequatur, distinctio expedita modi placeat temporibus velit. Incidunt itaque obcaecati rerum!
                </div>
                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, quam similique. Aperiam enim facere libero.
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
                width: 500,
                height: 250,
                isStacked: true,
                colors: [ '#FAEBCC', '#b7eaf3',],
                legend: { position: 'bottom', maxLines: 3 },
            };

            let chart = new google.visualization.ColumnChart(element);
            chart.draw(data, options);
        }

        google.charts.load('current', { packages: ['corechart', 'bar'] });
        google.charts.setOnLoadCallback(drawChart);
    </script>

@endsection

@extends('layouts.app')


@section('content')
{{--        @dd($data)--}}

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="com-md-12">
                <h3>Страховки у которых заканчивается срок действия в течение {{$upcomingPeriod}} дней</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Единица техники</th>
                            <th scope="col">Страховая компания</th>
                            <th scope="col">Тип страховки</th>
                            <th scope="col">Страховая компания</th>
                            <th scope="col" class="text-center">Дата оформления</th>
                            <th scope="col" class="text-center">Дата окончания</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $index=>$el)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{$el->vehicle}}</td>
                                <td>{{$el->vin}}</td>
                                <td>{{$el->insurance_type??'--'}}</td>
                                <td>{{$el->ic_name??'--'}}</td>
                                <td>{{$el->date_open?date('d.m.Y',strtotime($el->date_open)):'--'}}</td>
                                <td>{{$el->date_close?date('d.m.Y',strtotime($el->date_close)):'--'}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@endsection

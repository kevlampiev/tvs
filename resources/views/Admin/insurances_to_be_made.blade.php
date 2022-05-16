@extends('layouts.admin')


@section('content')
{{--        @dd($data)--}}

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="com-md-12">
                <h3>Страховки, требующие оформления</h3>
            </div>
        </div>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Просроченные страховки и страховки у которых заканчивается срок действия в течение {{$upcomingPeriod}} дней
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Единица техники</th>
                                <th scope="col">Страховая компания</th>
                                <th scope="col">Тип страховки</th>
                                <th scope="col" class="text-center">Дата оформления</th>
                                <th scope="col" class="text-center">Дата окончания</th>
                                <th scope="col" class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($insurancesToRenewal as $index=>$el)
                                <tr @if(!$el->date_close||$el->date_close<now()) class="text-danger" @endif >
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$el->vehicle}}</td>
                                    <td>{{$el->insurance_company??'--'}}</td>
                                    <td>{{$el->insurance_type??'--'}}</td>
                                    <td>{{$el->date_open?date('d.m.Y',strtotime($el->date_open)):'--'}}</td>
                                    <td>{{$el->date_close?date('d.m.Y',strtotime($el->date_close)):'--'}}</td>
                                    <td><a href="{{route('admin.vehicleSummary',['vehicle'=>$el->vehicle_id, 'page'=>'insurance_policies'])}}"> &#9776;Карточка </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Техника, которая была не застрахована ни разу
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Единица техники</th>
                                <th scope="col" class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($uninsuredVehicles as $index=>$el)
                                <tr @if(!$el->date_close||$el->date_close<now()) class="text-danger" @endif >
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$el->vehicle}}</td>
                                    <td><a href="{{route('admin.vehicleSummary',['vehicle'=>$el->vehicle_id, 'page'=>'insurance_policies'])}}"> &#9776;Карточка </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

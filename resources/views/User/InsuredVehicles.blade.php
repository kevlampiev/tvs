@extends('layouts.app')


@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="com-md-12">
                <h3>Отчет о состоянии страхования техники</h3>
            </div>
        </div>


        <div class="accordion" id="accordionExample">
            @foreach($insurances as $key=>$insurance_type)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{str_slug($key)}}" aria-expanded="true" aria-controls="collapseOne">
                            {{$key}}
                        </button>
                    </h2>
                    <div id="{{str_slug($key)}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Единица техники</th>
                                <th scope="col">Страховщик</th>
                                <th scope="col">Период страхования</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($insurance_type as $index=>$el)
                                <tr @if(!$el->date_close||$el->date_close<now()) class="text-danger" @endif>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$el->vehicle}}</td>
                                    @if ($el->insurance_company)
                                        <td >{{$el->insurance_company}}</td>
                                        <td>{{Carbon\Carbon::parse($el->date_open)->format('d.m.Y')}} -
                                            {{Carbon\Carbon::parse($el->date_close)->format('d.m.Y')}}</td>
                                    @else
                                        <td colspan="2"> техника не застрахована </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
@endsection

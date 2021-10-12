@extends('layouts.app')


@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="com-md-12">
                <h3>Действующие страховки (по страховым компаниям)</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">

                @foreach($actualInsurances as $key=>$insurance_type)
                    <h4 class="mt-lg-4 font-weight-bold"> {{$key}}</h4>
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Единица техники</th>
                            <th scope="col">Страховщик</th>
                            <th scope="col">Период страхования</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($insurance_type as $index=>$el)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$el->vehicle}}</td>
                                    <td>{{$el->insurance_company}}</td>
                                    <td>{{Carbon\Carbon::parse($el->date_open)->format('d.m.Y')}} -
                                        {{Carbon\Carbon::parse($el->date_close)->format('d.m.Y')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection

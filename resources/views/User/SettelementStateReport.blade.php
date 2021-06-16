@extends('layouts.app')

@section('content')
{{--    @dd($data)--}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach($data as $key=>$company)
                    <h4 class="mt-lg-4"> {{$key}}</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Контрагент</th>
                            <th scope="col">Тип договора</th>
                            <th scope="col">Номер и дата</th>
                            <th scope="col">Приобретеное оборудование</th>
                            <th scope="col">Стоимость оборудования / Основной долг</th>
                            <th scope="col">Всего выплат по договору</th>
                            <th scope="col">Уплачено</th>
                            <th scope="col">Просрочено на {{$reportDate}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($company as $index=>$el)
                        <tr>
                            <th scope="row">{{$index}}</th>
                            <td>{{$el->counterparty_name}}</td>
                            <td>{{$el->agreementType->name}}</td>
                            <td>{{$el->agr_number}} от {{$el->date_open}}</td>
                            <td>
                                <ul>
                                @foreach($el->vehicles as $vehicle)
                                    <li>{{$vehicle->vehicleType->name}}/{{$vehicle->name}} /{{$vehicle->bort_number}}</li>
                                @endforeach
                                </ul>
                            </td>
                            <td>{{$el->principal_amount}} от {{$el->currency}}</td>
                            <td>{{$el->total_payments}}</td>
                            <td>{{$el->payed}}</td>
                            <td>{{$el->must_be_payed_by_date - $el->payed}}  </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection

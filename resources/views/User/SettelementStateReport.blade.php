@extends('layouts.app')


@section('content')
{{--    @dd($data)--}}

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="com-md-12">
                <h3>Задолженость по финансовым договорам</h3>
                <form mephod="GET">

                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">

                @foreach($data as $key=>$company)
                    <h4 class="mt-lg-4"> {{$key}}</h4>
                    <table class="table">
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
                            <th scope="row">{{$index+1}}</th>
                            <td>{{$el->counterparty_name}}</td>
                            <td>{{$el->agreementType->name}}</td>
                            <td>{{$el->agr_number}} от {{$el->date_open}}</td>
                            <td>
                                <ul>
                                @forelse($el->vehicles as $vehicle)
                                    <li>{{$vehicle->vehicleType->name}}  {{$vehicle->name}}  {{$vehicle->bort_number}}</li>
                                @empty
                                    -----
                                @endforelse
                                </ul>
                            </td>
                            <td class="text-right">{{number_format($el->principal_amount,2)}} {{$el->currency}}</td>
                            <td class="text-right">{{number_format($el->total_payments,2)}}</td>
                            <td class="text-right">{{number_format($el->payed,2)}}</td>
                            <td class="text-right">{{number_format($el->must_be_payed_by_date - $el->payed,2)}}  </td>
                        </tr>
                        @endforeach
{{--                        @dd($company)--}}
                        <tr>
                            <th colspan="4">Всего </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection

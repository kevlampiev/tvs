@extends('layouts.app')


@section('content')
    {{--    @dd($data)--}}

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="com-md-12">
                <h3>Задолженость по финансовым договорам</h3>
                <form class="form-inline" methos="GET">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="reportDate" class="sr-only">Дата формирования</label>
                        <input type="date" class="form-control" id="reportDate"
                               value="{{$reportDate??now()}}" name="reportDate">
                    </div>
                    <button type="submit" class="btn btn-outline-secondary mb-2">Изменить дату</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">

                @foreach($data as $key=>$company)
                    <h4 class="mt-lg-4 font-weight-bold"> {{$key}}</h4>
                    <table class="table">
                        <thead class="thead-light">
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
                            <th scope="col">Осталось оплатить</th>
                            <th scope="col"></th>
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
                                <td class="text-right">{{number_format($el->must_be_payed_by_date - $el->payed,2)}}  </td>
                                <td class="text-left">
{{--                                    <a href="{{route('user.agreementSettlements', ['id'=>$el->id])}}">&#8801;Детально</a>--}}
                                    <a href="{{route('admin.agreementSummary', ['agreement'=>$el->id])}}">
                                        &#8801;Карточка договора
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        {{--                        @dd($company)--}}
                        <tr>
                            <th colspan="5">Всего</th>
                            <th class="text-right">{{number_format($company->sum('principal_amount'),2)}}</th>
                            <th class="text-right">{{number_format($company->sum('total_payments'),2)}}</th>
                            <th class="text-right">{{number_format($company->sum('payed'),2)}}</th>
                            <th class="text-right">
                                {{number_format($company->sum('must_be_payed_by_date')-$company->sum('payed'),2)}}
                            </th>
                            <th class="text-right">
                                {{number_format($company->sum('total_payments')-$company->sum('payed'),2)}}
                            </th>
                        </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection

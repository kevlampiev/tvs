@extends('layouts.app')


@section('content')
    {{--    @dd($data)--}}

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="com-md-12">
                <h3>Ожидаемые платежи в течение 14 дней</h3>
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
                            <th scope="col">Просрочено на {{today()}}</th>
                            <th scope="col">Ближайшие платежи по сроку</th>
                            <th scope="col">Всего</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($company as $index=>$el)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{$el->counterparty->name}}</td>
                                <td>{{$el->agreementType->name}}</td>
                                <td>{{$el->agr_number}} от {{$el->date_open}}</td>
                                <td class="text-right">{{number_format($el->overdue,2)}}</td>
                                <td class="text-right">{{number_format($el->nearestPayments,2)}}</td>
                                <td class="text-right">{{number_format($el->overdue + $el->nearestPayments,2)}}  </td>
                                <td class="text-left">
                                    <a href="{{route('user.agreementSettlements', ['agreement'=>$el])}}">&#8801;Детально</a>
                                </td>
                            </tr>
                        @endforeach
                        {{--                        @dd($company)--}}
                        <tr>
                            <th colspan="4">Всего</th>
                            <th class="text-right">{{number_format($company->sum('overdue'),2)}}</th>
                            <th class="text-right">{{number_format($company->sum('nearestPayments'),2)}}</th>
                            <th class="text-right">{{number_format($company->sum('overdue')+$company->sum('nearestPayments'),2)}}</th>

                        </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection

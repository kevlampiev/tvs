@extends('layouts.app')


@section('content')
    {{--    @dd($data)--}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    <h3>Предстояшие платежи (14 дней) </h3>
                    <div class="dashBoardEl">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Дата</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Компания</th>
                                <th scope="col">Контрагент</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($payments as $index=>$payment)
                            <tr {{($payment->payment_date=='просрочено')?'class=text-danger':''}}>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$payment->payment_date}}</td>
                                <td class="text-right">{{number_format($payment->amount,2)}}</td>
                                <td>{{$payment->company}}</td>
                                <td>{{$payment->counterparty}}</td>
                            </tr>
                            @empty
                                <td colspan="5">Нет записей</td>
                            @endforelse
                            <tr class="font-weight-bold">
                                <th colspan="2" class="text-right">Всего</th>
                                <td class="text-right">{{number_format($payments->sum('amount'),2)}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
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
            overflow-y: scroll;
            }
        .dashBoardEl {
            height: 280px;
            overflow-y: scroll;
        }
    </style>
@endsection

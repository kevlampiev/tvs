@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h3>Договор №{{$agreement->agr_number}} от {{$agreement->date_open}}</h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                @include('Admin.agreement-summary.agreement-main')
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Дата платежа</th>
                        <th scope="col">Сумма в оплату</th>
                        <th scope="col">Статус</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($payments as $index=>$payment)
                        <tr
                            {{($payment->status=='погашен')?'class=text-secondary':''}}
                            {{($payment->status=='просрочен')?'class=text-danger':''}}
                        >
                            <th scope="row">{{$index+1}}</th>
                            <td>{{$payment->payment_date}}</td>
                            <td class="text-right">{{number_format($payment->amount,2)}}</td>
                            <td>
                                {{$payment->status}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Нет данных для отображения</td>
                        </tr>
                    @endforelse
                    <tr>
                        <th colspan="2" class="text-right">Всего: </th>
                        <th class="text-right">{{number_format($payments->sum('amount'),2)}}</th>
                        <th>   </th>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

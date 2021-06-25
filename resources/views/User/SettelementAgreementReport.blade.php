@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h3>Договор №{{$agreement->agr_number}} от {{$agreement->date_open}}</h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                @include('Admin.components.agreement-main')
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
                            {{($payment->status==='погашен')?'class=text-secondary':''}}
                            {{($payment->status=='просрочен')?'class=text-danger':''}}
                        >
                            <th scope="row">{{$index+1}}</th>
                            <td>{{$payment->payment_date}}</td>
                            <td>{{number_format($payment->amount,2)}}</td>
                            <td>
                                {{$payment->status}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Нет данных для отображения</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

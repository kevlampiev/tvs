<div class="col-md6 p-4">
    <h4>Платежи в соответствии с договором</h4>
    <div class="row">
        <a class="btn btn-outline-info"
           href="{{route('admin.addAgrPayment', ['agreement'=>$agreement])}}">Новый платеж</a>
        <a class="btn btn-outline-info"
           href="{{route('admin.addMassPayment', ['agreement'=>$agreement])}}">Добавить серию платежей</a>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Дата</th>
            <th scope="col">Сумма</th>
            <th scope="col">Валюта</th>
            <th scope="col">Примечание</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @forelse($payments as $index => $payment)
            <tr {{($payment->canceled_date)?'class=text-black-50':''}}>
                <th scope="row">{{$index+1}}</th>
                <td>{{$payment->payment_date}}</td>
                <td class="text-right">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                <td class="text-left">{{$payment->currency}}</td>
                <td class="text-center">{{$payment->canceled_date}}</td>
                <td><a href="{{route('admin.editAgrPayment', ['agreement'=>$agreement, 'payment' => $payment])}}">
                        &#9998;Изменить </a></td>
                <td><a href="{{route('admin.movePaymentToReal', ['agreement'=>$agreement, 'payment' => $payment])}}">
                        &euro; В оплату </a></td>

                <td><a href="{{route('admin.deleteAgrPayment', ['agreement'=>$agreement, 'payment' => $payment])}}">
                        &#10008;Удалить </a></td>
            </tr>
        @empty
            <tr>
                <th colspan="6">Нет записей</th>
            </tr>
        @endforelse
        <tr>
            <th colspan="2">Итого</th>
            <th class="text-right">{{number_format($payments->sum('amount'), 2)}}</th>
            <th class="text-left"></th>
            <th></th>
            <th></th>
        </tr>
        </tbody>
    </table>


</div>


<div class="col-md-6 p-4">
    <h4>Реальные оплаты</h4>
    <div class="row">
        <div class="col-md-12">
        <a class="btn btn-outline-info"
           href="{{route('admin.addRealPayment', ['agreement'=>$agreement])}}">Новый платеж</a>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Дата</th>
            <th scope="col">Сумма</th>
            <th scope="col">Валюта</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @forelse($realPayments as $payment)
            <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{\Carbon\Carbon::parse($payment->payment_date)->format('d.m.Y')}}</td>
                <td class="text-right">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                <td class="text-left">{{$payment->currency}}</td>
                <td><a href="{{route('admin.editRealPayment', ['agreement'=>$agreement, 'payment' => $payment])}}">
                        &#9998;Изменить </a></td>
                <td><a href="{{route('admin.deleteRealPayment', ['agreement'=>$agreement, 'payment' => $payment])}}"
                       onclick="return confirm('Действительно удалить данные о платеже?')">
                        &#10008;Удалить </a></td>
            </tr>
        @empty
            <tr>
                <th colspan="6">Нет записей</th>
            </tr>
        @endforelse
        <tr>
            <th colspan="2">Всего</th>
            <th class="text-right">{{number_format($realPayments->sum('amount'), 2)}}</th>
            <th class="text-left"></th>
            <th></th>
            <th></th>
        </tr>
        </tbody>
    </table>


</div>


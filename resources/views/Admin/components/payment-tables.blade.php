
<div class="row">
    <div class="col-md6 p-4">
        <h4>Платежи в соответствии с договором</h4>
        <div class="row">
            <a class="btn btn-outline-info"
               href="{{route('admin.addAgrPayment', ['agreement'=>$agreement])}}">Новый платеж</a>
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
            @forelse($agreement->payments as $index => $payment)
                <tr>
                    <th scope="row">{{$index}}</th>
                    <td>{{$payment->payment_date}}</td>
                    <td>{{$payment->amount}}</td>
                    <td>{{$payment->currency}}</td>
                    <td><a href="{{route('admin.editAgrPayment', ['agreement'=>$agreement, 'payment' => $payment])}}">
                            &#9998;Изменить  </a></td>
                    <td><a href="{{route('admin.deleteAgrPayment', ['agreement'=>$agreement, 'payment' => $payment])}}">
                            &#10008;Удалить </a></td>
                </tr>
            @empty
                <tr>
                    <th colspan="6">Нет записей</th>
                </tr>
            @endforelse
            </tbody>
        </table>


    </div>
    <div class="col-md6 p-2">
        <h4>Реальные оплаты по договору</h4>
    </div>
</div>


<div class="col-md-6 p-4">
    <h4>Платежи в соответствии с договором</h4>
    <div class="row">
        <div class="col-md-12">
        <a class="btn btn-outline-info mr-2"
           href="{{route('admin.addAgrPayment', ['agreement'=>$agreement])}}">Новый платеж</a>
        <a class="btn btn-outline-info mr-2"
           href="{{route('admin.massAddPayments', ['agreement'=>$agreement])}}">Добавить серию платежей</a>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Дата</th>
            <th scope="col">Сумма</th>
            <th scope="col">Валюта</th>
            <th scope="col">Состояние</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @php
            $totalPayed = $agreement->realPayments->sum('amount');
        @endphp
        @forelse($payments as $payment)
            <tr >
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{\Carbon\Carbon::parse($payment->payment_date)->format('d.m.Y')}}</td>
                <td class="text-right">{{number_format($payment->amount, 2, ',', ' ')}}</td>
                <td class="text-left">{{$payment->currency}}</td>
                @php
                    $totalPayed = $totalPayed - $payment->amount ;
                @endphp
                <td class="text-left">
                    @if($payment->payment_date>now())
                        Срочный
                    @elseif($totalPayed<0)
                        @if(abs($totalPayed)>=$payment->amount)
                          <span class="text-danger">Просрочен</span>
                        @else
                            <span class="text-danger">Погашен частично</span>
                        @endif
                    @else
                        <span class="text-secondary">Погашен</span>
                    @endif

                </td>
                <td><a href="{{route('admin.editAgrPayment', ['agreement'=>$agreement, 'payment' => $payment])}}">
                        &#9998;Изменить </a></td>
                <td><a href="{{route('admin.movePaymentToReal', ['agreement'=>$agreement, 'payment' => $payment])}}">
                        &euro; В оплату </a></td>

                <td><a href="{{route('admin.deleteAgrPayment', ['agreement'=>$agreement, 'payment' => $payment])}}"
                       onclick="return confirm('Действительно удалить данные о платеже?')">
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

    @if($payments->count()>0)
    <form action="{{route('admin.massDeletePayments', ['agreement'=>$agreement])}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-outline-danger"
           onclick="return confirm('Действительно удалить все плановые платежи договора?')"
        >Удалить все платежи</button>
    </form>
    @endif

</div>


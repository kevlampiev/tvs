<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Компания</th>
        <th scope="col">Контрагент</th>
        <th scope="col">Тип договора</th>
        <th scope="col">Название договора</th>
        <th scope="col">Номер договора</th>
        <th scope="col">Дата договора</th>
        <th scope="col">Дата завершения</th>
        <th scope="col">Реальная дата закрытия</th>
        <th scope="col">Приобретенная техника</th>
        <th scope="col">Дата реального платежа по договору</th>
        <th scope="col">Сумма платежа</th>
        <th scope="col">Валюта платежа</th>
        <th scope="col">Комментарий</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $index=>$payment)
        <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$payment->agreement->company->name}}</td>
            <td>{{$payment->agreement->counterparty->name}}</td>
            <td>{{$payment->agreement->agreementType->name}}</td>
            <td>{{$payment->agreement->name}}</td>
            <td>{{$payment->agreement->agr_number}}</td>
            <td>{{$payment->agreement->date_open}}</td>
            <td>{{\Carbon\Carbon::parse($payment->agreement->date_close)->format('d.m.Y')}}</td>
            <td>{{\Carbon\Carbon::parse($payment->agreement->real_date_close)->format('d.m.Y')}}</td>
            <td>
                @foreach($payment->agreement->vehicles as $vehicle)
                    {{$vehicle->name}},(VIN: {{$vehicle->VIN}})
                @endforeach
            </td>
            <td>{{\Carbon\Carbon::parse($payment->payment_date)->format('d.m.Y')}}</td>
            <td>{{$payment->amount}}</td>
            <td>{{$payment->currency}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

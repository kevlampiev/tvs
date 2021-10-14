<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Наименование договора</th>
        <th scope="col">Компания</th>
        <th scope="col">Контрагент</th>
        <th scope="col">Тип договора</th>
        <th scope="col">Номер договора</th>
        <th scope="col">Описание</th>
        <th scope="col">Дата начала</th>
        <th scope="col">Срок договора</th>
        <th scope="col">Дата фактического завершения</th>
        <th scope="col">Сумма договора</th>
        <th scope="col">Валюта</th>
        <th scope="col">Процентная ставка</th>
        <th scope="col">Приобретенная техника</th>
    </tr>
    </thead>
    <tbody>
    @foreach($agreements as $index=>$agreement)
        <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$agreement->name}}</td>
            <td>{{$agreement->company->name}}</td>
            <td>{{$agreement->counterparty->name}}</td>
            <td>{{$agreement->agreementType->name}}</td>
            <td>{{$agreement->agr_number}}</td>
            <td>{{$agreement->description}}</td>
            <td>{{\Carbon\Carbon::parse($agreement->date_open)->format('d.m.Y')}}</td>
            <td>{{\Carbon\Carbon::parse($agreement->date_close)->format('d.m.Y')}}</td>
            <td>{{\Carbon\Carbon::parse($agreement->real_date_close)->format('d.m.Y')}}</td>
            <td>{{$agreement->amount}}</td>
            <td>{{$agreement->currency}}</td>
            <td>{{$agreement->interest_rate}}</td>
            <td>
                @foreach($agreement->vehicles as $vehicle)
                     {{$vehicle->vehicleType->name}} {{$vehicle->name}} VIN:{{$vehicle->name}};
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

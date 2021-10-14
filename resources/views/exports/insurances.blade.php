<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Единица техники</th>
        <th scope="col">Страховщик</th>
        <th scope="col">Тип страховки</th>
        <th scope="col">Номер полиса</th>
        <th scope="col">Начало периода страхования</th>
        <th scope="col">Окончание периода страхования</th>
        <th scope="col">Страховая сумма</th>
        <th scope="col">Валюта страховой суммы</th>
        <th scope="col">Страховая премия</th>
        <th scope="col">Валюта страховой премии</th>
    </tr>
    </thead>
    <tbody>
    @foreach($insurances as $index=>$insurance)
        <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$insurance->vehicle->name}}, VIN: {{$insurance->vehicle->vin}}</td>
            <td>{{$insurance->insuranceCompany->name}}</td>
            <td>{{$insurance->insuranceType->name}}</td>
            <td>{{$insurance->policy_number}}</td>
            <td> {{\Carbon\Carbon::parse($insurance->date_open)->format('d.m.Y')}} </td>
            <td> {{\Carbon\Carbon::parse($insurance->date_close)->format('d.m.Y')}} </td>
            <td>{{$insurance->insurance_amount}}</td>
            <td>{{$insurance->amount_currency}}</td>
            <td>{{$insurance->insurance_premium}}</td>
            <td>{{$insurance->premium_currency}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

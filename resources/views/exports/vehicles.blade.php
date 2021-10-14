<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Тип техники</th>
        <th scope="col">Производитель</th>
        <th scope="col">Наименование</th>
        <th scope="col">VIN</th>
        <th scope="col">Бортовой номер</th>
        <th scope="col">Год выпуска</th>
        <th scope="col">Торговая марка</th>
        <th scope="col">Модель</th>
        <th scope="col">Цена приобретения</th>
        <th scope="col">Валюта</th>
        <th scope="col">Дата приобретения</th>
        <th scope="col">Договоры покупки</th>
        <th scope="col">Страховки</th>
        <th scope="col">Договоры залога</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vehicles as $index=>$vehicle)
        <tr>
            <th scope="row">{{$index+1}}</th>
            <td>{{$vehicle->vehicleType->name}}</td>
            <td>{{$vehicle->manufacturer->name}}</td>
            <td>{{$vehicle->name}}</td>
            <td>{{$vehicle->vin}}</td>
            <td>{{$vehicle->bort_number}}</td>
            <td>{{$vehicle->prod_year}}</td>
            <td>{{$vehicle->trademark}}</td>
            <td>{{$vehicle->model}}</td>
            <td>{{$vehicle->price}}</td>
            <td>{{$vehicle->currency}}</td>
            <td>{{\Carbon\Carbon::parse($vehicle->purchase_date)->format('d.m.Y')}}</td>
            <td>
                @foreach($vehicle->agreements as $agreement)
                     {{$agreement->name}} №  {{$agreement->agr_number}} от
                    {{\Carbon\Carbon::parse($agreement->date_open)->format('d.m.Y')}} ;
                @endforeach
            </td>
            <td>
                @foreach($vehicle->insurances as $insurance)
                     {{$insurance->insuranceType->name}}  Полис  {{$insurance->insuranceCompany->name}}  №
                    {{$insurance->policy_number}}, срок действия с
                    {{\Carbon\Carbon::parse($insurance->date_open)->format('d.m.Y')}} по
                    {{\Carbon\Carbon::parse($insurance->date_close)->format('d.m.Y')}} ;
                @endforeach
            </td>
            <td> -- </td>
        </tr>
    @endforeach
    </tbody>
</table>

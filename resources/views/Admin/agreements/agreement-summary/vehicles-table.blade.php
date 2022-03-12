<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Наименование</th>
        <th scope="col">Модель</th>
        <th scope="col">Тип</th>
        <th scope="col">Бортовой номер</th>
        <th scope="col">Год выпуска</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($agreement->vehicles as $index => $vehicle)
        <tr @if($vehicle->sale_date&&$vehicle->sale_date<=now()) class="text-black-50 sold-vehicle"@endif>
            <th scope="row">{{$index+1}}</th>
            <td>{{$vehicle->name}}</td>
            <td>{{$vehicle->model}}</td>
            <td>{{$vehicle->vehicleType->name}}</td>
            <td>{{$vehicle->bort_number}}</td>
            <td>{{$vehicle->prod_year}}</td>
            <td>
                <a href="{{route('admin.vehicleSummary',['vehicle'=>$vehicle])}}"> &#9776;Карточка </a>
                <a href="{{route('admin.agreementDetachVehicle', ['agreement'=>$agreement, 'vehicle'=>$vehicle])}}"
                   onclick="return confirm('Действительно удалить данные о единице техники?')">
                    &#10008;Удалить </a>
            </td>
        </tr>
    @empty
        <tr>
            <th colspan="7">1</th>
        </tr>
    @endforelse
    </tbody>
</table>


@section("styles")
    <style>
        .sold-vehicle {
            text-decoration: line-through;
        }
    </style>
@endsection

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
            <tr>
                <th scope="row">{{$index}}</th>
                <td>{{$vehicle->name}}</td>
                <td>{{$vehicle->model}}</td>
                <td>{{$vehicle->vehicleType->name}}</td>
                <td>{{$vehicle->bort_number}}</td>
                <td>{{$vehicle->prod_year}}</td>
                <td><a href="{{route('admin.agreementDetachVehicle', ['agreement'=>$agreement, 'vehicle'=>$vehicle])}}"> &#10008;Удалить </a></td>
            </tr>
        @empty
            <tr>
                <th colspan="7">1</th>
            </tr>
        @endforelse
    </tbody>
</table>

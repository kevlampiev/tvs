@extends('Admin.layout')

@section('title')
    Администратор| Единицы техники
@endsection

@section('content')

    <div class="row">
        <h2>Техника в наличии</h2>
    </div>

    <div class="row">
        <a class="btn btn-outline-info" href="{{route('admin.addVehicle')}}">Новая единица</a>
    </div>

    <div class="row">
        <div class="col-md-2">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Тип техники</th>
                    <th scope="col">Производитель</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Заводской номер/VIN</th>
                    <th scope="col">Бортовой номер</th>
                    <th scope="col">Год выпуска</th>
                    <th scope="col">Модель</th>
                    <th scope="col">Цена приобретения</th>
                    <th scope="col">Валюта</th>
                    <th scope="col">Дата приобретения</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($vehicles as $vehicle)
                <tr>
                    <th scope="row">{{$vehicle->id}}</th>
                    <td>{{$vehicle->vehicleType->name}}</td>
                    <td>{{$vehicle->manufacturer->name}}</td>
                    <td>{{$vehicle->name}}</td>
                    <td>{{$vehicle->vin}}</td>
                    <td>{{$vehicle->bort_number}}</td>
                    <td>{{$vehicle->prod_year}}</td>
                    <td>{{$vehicle->model}}</td>
                    <td>{{$vehicle->market_price}}</td>
                    <td>{{$vehicle->currency}}</td>
                    <td>{{$vehicle->estimate_date}}</td>
                    <td><a href="{{route('admin.editVehicle',['vehicle'=>$vehicle])}}"> &#9998;Изменить </a> </td>
                    <td><a href="{{route('admin.deleteVehicle',['vehicle'=>$vehicle])}}"> 	&#10008;Удалить </a> </td>
                </tr>
                @empty
                    <p>Нет записей</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

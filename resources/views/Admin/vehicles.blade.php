@extends('layouts.admin')

@section('title')
    Администратор| Единицы техники
@endsection

@section('content')

    <div class="row">
        <h2>Техника в наличии</h2>
    </div>

    @if ($filter!=='')
        <div class="alert alert-primary" role="alert">
            Установлен фильтр " <strong> {{$filter}} </strong> "
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-outline-info" href="{{route('admin.addVehicle')}}">Новая единица</a>
        </div>
        <div class="col-md-6">
            <form class="form-inline my-2 my-lg-0" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск техники" aria-label="Search" name="searchStr"
                       value="{{isset($filter)?$filter:''}}">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Поиск</button>
            </form>
        </div>
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
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($vehicles as $index => $vehicle)
                    <tr>
                        <th scope="row">{{($index+1)}}</th>
                        <td>{{$vehicle->vehicleType->name}}</td>
                        <td>{{$vehicle->manufacturer->name}}</td>
                        <td>{{$vehicle->name}}</td>
                        <td>{{$vehicle->vin}}</td>
                        <td>{{$vehicle->bort_number}}</td>
                        <td>{{$vehicle->prod_year}}</td>
                        <td>{{$vehicle->model}}</td>
                        <td>{{$vehicle->price}}</td>
                        <td>{{$vehicle->currency}}</td>
                        <td>{{$vehicle->purchase_date}}</td>
                        <td><a href="{{route('admin.vehicleSummary',['vehicle'=>$vehicle])}}"> &#9776;Карточка </a></td>
                        <td><a href="{{route('admin.editVehicle',['vehicle'=>$vehicle])}}"> &#9998;Изменить </a></td>
                        <td><a href="{{route('admin.deleteVehicle',['vehicle'=>$vehicle])}}"
                               onclick="return confirm('Действительно удалить данные о единице техники?')"> &#10008;Удалить </a></td>
                    </tr>
                @empty
                    <td colspan="14">Нет записей</td>
                @endforelse
                </tbody>
            </table>
            {{$vehicles->links()}}
        </div>
    </div>
@endsection

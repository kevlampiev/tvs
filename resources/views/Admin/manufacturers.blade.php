@extends('Admin.layout')

@section('title')
    Администратор| Справочники
@endsection

@section('content')

    <div class="row">
        <h2>Типы техники</h2>
    </div>

    <div class="row">
        <a class="btn btn-outline-info" href="{{route('admin.addManufacturer')}}">Новый производитель</a>
    </div>

    <div class="row">
        <div class="col-md-2">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($manufacturers as $manufacturer)
                <tr>
                    <th scope="row">{{$manufacturer->id}}</th>
                    <td>{{$manufacturer->name}}</td>
                    <td><a href="{{route('admin.editManufacturer',['manufacturer'=>$manufacturer])}}"> &#9998;Изменить </a> </td>
                    <td><a href="{{route('admin.deleteManufacturer',['manufacturer'=>$manufacturer])}}"> 	&#10008;Удалить </a> </td>
                </tr>
                @empty
                    <p>Нет записей</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

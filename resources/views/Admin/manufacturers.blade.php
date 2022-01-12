@extends('layouts.admin')

@section('title')
    Администратор| Справочники
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
        <h2>Производители</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <a class="btn btn-outline-info" href="{{route('admin.addManufacturer')}}">Новый производитель</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
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
                @forelse($manufacturers as $index=>$manufacturer)
                    <tr>
                        <th scope="row">{{$index + 1}}</th>
                        <td>{{$manufacturer->name}}</td>
                        <td><a href="{{route('admin.editManufacturer',['manufacturer'=>$manufacturer])}}"> &#9998;Изменить </a>
                        </td>

                        @if ($manufacturer->vehicles_count===0)
                            <td><a href="{{route('admin.deleteManufacturer',['manufacturer'=>$manufacturer])}}"
                                   onclick="return confirm('Действительно удалить данные о произвоителе?')">
                                    &#10008;Удалить </a>
                            </td>
                        @else
                            <td><p class="text-muted">&#10008;Удалить </p></td>
                        @endif
                    </tr>
                @empty
                    <p>Нет записей</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

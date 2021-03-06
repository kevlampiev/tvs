@extends('layouts.admin')

@section('title')
    Администратор| Справочники
@endsection

@section('content')

    <div class="row">
        <h2>Типы техники</h2>
    </div>

    <div class="row">
        <a class="btn btn-outline-info" href="{{route('admin.addType')}}">Новый тип</a>
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
                @forelse($types as $type)
                    <tr>
                        <th scope="row">{{$type->id}}</th>
                        <td>{{$type->name}}</td>
                        <td><a href="{{route('admin.editType',['type'=>$type])}}"> &#9998;Изменить </a></td>
                        @if ($type->vehicles_count===0)
                            <td><a href="{{route('admin.deleteType',['type'=>$type])}}"
                                   onclick="return confirm('Действительно удалить данные о типе техники?')"> &#10008;Удалить </a></td>
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

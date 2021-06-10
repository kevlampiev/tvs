@extends('Admin.layout')

@section('title')
    Администратор| Справочники
@endsection

@section('content')
    <div class="row">
        <h2>Виды договоров</h2>
    </div>

    <div class="row">
        <a class="btn btn-outline-info" href="{{route('admin.addAgrType')}}">Новый тип</a>
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
                @forelse($agrTypes as $type)
                    <tr>
                        <th scope="row">{{$type->id}}</th>
                        <td>{{$type->name}}</td>
                        <td><a href="{{route('admin.editAgrType',['agrType'=>$type])}}"> &#9998;Изменить </a></td>
                        @if ($type->agreements_count===0)
                            <td><a href="{{route('admin.deleteAgrType',['agrType'=>$type])}}"> &#10008;Удалить </a></td>
                        @else
                            <td> <p class="text-muted">&#10008;Удалить </p></td>
                        @endif
                    </tr>
                @empty
                    <td colspan="4">Нет записей</td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

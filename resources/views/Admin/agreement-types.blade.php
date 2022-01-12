@extends('layouts.admin')

@section('title')
    Администратор| Справочники
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
        <h2>Виды договоров</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <a class="btn btn-outline-info" href="{{route('admin.addAgrType')}}">Новый тип</a>
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
                @forelse($agrTypes as $index => $type)
                    <tr>
                        <th scope="row">{{$index + 1}}</th>
                        <td>{{$type->name}}</td>
                        <td><a href="{{route('admin.editAgrType',['agrType'=>$type])}}"> &#9998;Изменить </a></td>
                        @if ($type->agreements_count===0)
                            <td><a href="{{route('admin.deleteAgrType',['agrType'=>$type])}}"
                                   onclick="return confirm('Действительно удалить данные о типе договора?')">
                                    &#10008;Удалить </a></td>
                        @else
                            <td><p class="text-muted">&#10008;Удалить </p></td>
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

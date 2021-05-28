@extends('Admin.layout')

@section('title')
    Администратор| Справочники
@endsection

@section('content')

    <div class="row">
        <h2>Компании группы</h2>
    </div>

    <div class="row">
        <a class="btn btn-outline-info" href="{{route('admin.addCompany')}}">Добавить компанию</a>
    </div>

    <div class="row">
        <div class="col-md-2">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Код</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($companies as $company)
                    <tr>
                        <th scope="row">{{$company->id}}</th>
                        <td>{{$company->name}}</td>
                        <td><a href="{{route('admin.editCompany',['company'=>$company])}}"> &#9998;Изменить </a>
                        </td>
                        <td><a href="{{route('admin.deleteCompany',['company'=>$company])}}"> &#10008;Удалить </a>
                        </td>
                    </tr>
                @empty
                    <td colspan="5">Нет записей</td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

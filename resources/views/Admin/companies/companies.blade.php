@extends('layouts.admin')

@section('title')
    Администратор| Справочники
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
        <h2>Компании группы</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <a class="btn btn-outline-info" href="{{route('admin.addCompany')}}">Добавить компанию</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Код</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($companies as $index=>$company)
                    <tr>
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$company->name}}</td>
                        <td>{{$company->code}}</td>
                        <td><a href="{{route('admin.companySummary',['company'=>$company])}}"> &#9776;Карточка </a>
                        <td><a href="{{route('admin.editCompany',['company'=>$company])}}"> &#9998;Изменить </a>
                        </td>
                        @if ($company->agreements_count===0)
                            <td>
                                <a href="{{route('admin.deleteCompany',['company'=>$company])}}"
                                   onclick="return confirm('Действительно удалить данные о компании?')"
                                > &#10008;Удалить </a>
                            </td>
                        @else
                            <td><p class="text-muted">&#10008;Удалить </p></td>
                        @endif
                    </tr>
                @empty
                    <td colspan="5">Нет записей</td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

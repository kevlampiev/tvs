@extends('layouts.admin')

@section('title')
    Администратор| Справочники
@endsection

@section('content')

    <div class="row">
        <h2>Страховые компании</h2>
    </div>

    <div class="row">
        <a class="btn btn-outline-info" href="{{route('admin.addInsuranceCompany')}}">Добавить новую</a>
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
                @forelse($insuranceCompanies as $index=>$company)
                    <tr>
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$company->name}}</td>
                        <td><a href="{{route('admin.editInsuranceCompany',['insuranceCompany'=>$company])}}"> &#9998;Изменить </a>
                        </td>
                        @if ($company->insurances->count()===0)
                            <td>
                                <a href="{{route('admin.deleteInsuranceCompany',['insuranceCompany'=>$company])}}"
                                   onclick="return confirm('Действительно удалить данные о страховщике?')"
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

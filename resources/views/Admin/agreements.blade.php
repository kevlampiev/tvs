@extends('layouts.admin')

@section('title')
    Администратор| Договоры
@endsection

@section('content')

    <div class="row">
        <h2>Заключенные договоры</h2>

    </div>

    @if ($filter!=='')
        <div class="alert alert-primary" role="alert">
            Установлен фильстр по номеру договора " <strong> {{$filter}} </strong> "
        </div>
    @endif

    <div class="row">
        <a class="btn btn-outline-info" href="{{route('admin.addAgreement')}}">Новый договор</a>
    </div>

    <div class="row">
        <div class="col-md-2">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Компания</th>
                    <th scope="col">Контрагент</th>
                    <th scope="col">Тип договора</th>
                    <th scope="col">Номер договора</th>
                    <th scope="col">Дата договора</th>
                    <th scope="col">Дата завершения</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($agreements as $index=>$agreement)
                    <tr>
                        <th scope="row">{{($index+1)}}</th>
                        <td>{{$agreement->name}}</td>
                        <td>{{$agreement->company->name}}</td>
                        <td>{{$agreement->counterparty->name}}</td>
                        <td>{{$agreement->agreementType->name}}</td>
                        <td>{{$agreement->agr_number}}</td>
                        <td>{{$agreement->date_open}}</td>
                        <td>{{$agreement->real_date_close}}</td>
                        <td><a href="{{route('admin.agreementSummary',['agreement'=>$agreement])}}">
                                &#9776;Карточка </a></td>
                        <td><a href="{{route('admin.editAgreement',['agreement'=>$agreement])}}"> &#9998;Изменить </a>
                        </td>
                        <td><a href="{{route('admin.deleteAgreement',['agreement'=>$agreement])}}"
                               onclick="return confirm('Действительно удалить данные о договоре?')"> &#10008;Удалить </a>
                        </td>
                    </tr>
                @empty
                    <td colspan="11">Нет записей</td>
                @endforelse
                </tbody>
            </table>
            {!! $agreements->links() !!}
        </div>
    </div>
@endsection

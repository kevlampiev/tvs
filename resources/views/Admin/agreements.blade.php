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
            Установлен фильтр по номеру договора " <strong> {{$filter}} </strong> "
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-outline-info" href="{{route('admin.addAgreement')}}">Новый договор</a>
        </div>
        <div class="col-md-6">
            <form class="form-inline my-2 my-lg-0" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск в договорах" aria-label="Search" name="searchStr"
                       value="{{isset($filter)?$filter:''}}">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Поиск</button>
            </form>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
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
                    <tr @if($agreement->real_date_close&&$agreement->real_date_close<=now()) class="text-black-50 agreement-close"@endif>
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
            {!! $agreements->appends(request()->input())->links() !!}
        </div>
    </div>
@endsection


@section("styles")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <style>
        .agreement-close {
            text-decoration: line-through;
        }
    </style>
@endsection

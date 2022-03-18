@extends('layouts.admin')

@section('title')
    Администратор| Справочники
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
        <h2>Реестр контрагентов</h2>
        </div>
    </div>

    @if ($filter!=='')
        <div class="alert alert-primary" role="alert">
            Установлен фильтр по имени " <strong> {{$filter}} </strong> "
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-outline-info" href="{{route('admin.addCounterparty')}}">Новый Контрагент</a>
        </div>
        <div class="col-md-6">
            <form class="form-inline my-2 my-lg-0" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск контрагента" aria-label="Search" name="searchStr"
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
                    <th scope="col">ИНН</th>
                    <th scope="col">Телефон</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($counterparties as $index=>$counterparty)
                    <tr>
                        <th scope="row">{{$index + 1}}</th>
                        <td>{{$counterparty->name}}</td>
                        <td>{{$counterparty->inn}}</td>
                        <td>{{$counterparty->phone}}</td>
                        <td>
                            <a href="{{route('admin.counterpartySummary',['counterparty'=>$counterparty])}}">
                                &#9776;Карточка </a>
                        </td>
                        <td><a href="{{route('admin.editCounterparty',['counterparty'=>$counterparty])}}"> &#9998;Изменить </a>
                        </td>
                        @if ($counterparty->agreements_count===0)
                            <td><a href="{{route('admin.deleteCounterparty',['counterparty'=>$counterparty])}}"
                                   onclick="return confirm('Действительно удалить данные о контрагенте?')">
                                    &#10008;Удалить </a>
                            </td>
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

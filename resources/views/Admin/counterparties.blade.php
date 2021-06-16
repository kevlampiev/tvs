@extends('layouts.admin')

@section('title')
    Администратор| Справочники
@endsection

@section('content')

    <div class="row">
        <h2>Реестр контрагентов</h2>
    </div>

    <div class="row">
        <a class="btn btn-outline-info" href="{{route('admin.addCounterparty')}}">Новый контрагент</a>
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
                @forelse($counterparties as $counterparty)
                    <tr>
                        <th scope="row">{{$counterparty->id}}</th>
                        <td>{{$counterparty->name}}</td>
                        <td><a href="{{route('admin.editCounterparty',['counterparty'=>$counterparty])}}"> &#9998;Изменить </a>
                        </td>
                        @if ($counterparty->agreements_count===0)
                            <td><a href="{{route('admin.deleteCounterparty',['counterparty'=>$counterparty])}}"> &#10008;Удалить </a>
                            </td>
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

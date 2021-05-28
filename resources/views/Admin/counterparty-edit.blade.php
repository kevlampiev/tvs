@extends('Admin.layout')

@section('title')
    Администратор|Редактирование контрагента
@endsection

@section('content')
    <h3> @if ($counterparty->id) Редактирование контрагента @else Добавить нового @endif</h3>
    <form action="{{route($route, $counterparty->id)}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Наименование</label>
                <input type="text" class="form-control" id="inputType" placeholder="Введите название" name="name"
                       value="{{$counterparty->name}}">
            </div>

            <button type="submit" class="btn btn-primary">
                @if ($counterparty->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.counterparties')}}">Отмена</a>

        </form>

    </form>


@endsection

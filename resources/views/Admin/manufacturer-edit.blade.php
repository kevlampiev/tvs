@extends('Admin.layout')

@section('title')
    Администратор|Редактирование производителя
@endsection

@section('content')
    <h3> @if ($manufacturer->id) Редактирование производителя @else Добавить нового производителя @endif</h3>
    <form action="{{route($route, $manufacturer->id)}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Наименование производителя</label>
                <input type="text" class="form-control" id="inputType" placeholder="Введите название производителя"
                       name="name"
                       value="{{$manufacturer->name}}">
            </div>

            <button type="submit" class="btn btn-primary">
                @if ($manufacturer->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.manufacturers')}}">Отмена</a>

        </form>

    </form>


@endsection

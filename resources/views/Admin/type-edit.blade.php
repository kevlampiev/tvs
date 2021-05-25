@extends('Admin.layout')

@section('title')
    Администратор|Редактирование типа
@endsection

@section('content')
    <h3> @if ($type->id) Изменение типа @else Добавить новый тип @endif</h3>
    <form action="{{route($route, $type->id)}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Наименование типа</label>
                <input type="text" class="form-control" id="inputType" placeholder="Введите название типа" name="name"
                value="{{$type->name}}">
            </div>

            <button type="submit" class="btn btn-primary">
                @if ($type->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.vehicleTypes')}}">Отмена</a>

        </form>

    </form>


@endsection

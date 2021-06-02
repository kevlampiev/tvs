@extends('Admin.layout')

@section('title')
    Администратор|Редактирование типа договора
@endsection

@section('content')
    <h3> @if ($agrType->id) Изменение типа договора @else Добавить новый тип договора @endif</h3>
    <form action="{{route($route, $agrType->id)}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Наименование типа договора</label>
                <input type="text" class="form-control" id="inputType" placeholder="Введите название типа" name="name"
                       value="{{$agrType->name}}">
            </div>

            <button type="submit" class="btn btn-primary">
                @if ($agrType->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.agrTypes')}}">Отмена</a>

        </form>

    </form>


@endsection

@extends('Admin.layout')

@section('title')
    Администратор|Редактирование компании
@endsection

@section('content')
    <h3> @if ($company->id) Редактирование компании @else Добавить новую @endif</h3>
    <form action="{{route($route, $company->id)}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Наименование</label>
                <input type="text" class="form-control" id="inputType" placeholder="Введите название" name="name"
                       value="{{$company->name}}">
            </div>

            <div class="form-group">
                <label for="inputCode">Код</label>
                <input type="text" class="form-control" id="inputCode" placeholder="Введите краткий код" name="code"
                       value="{{$company->code}}">
            </div>

            <button type="submit" class="btn btn-primary">
                @if ($company->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.companies')}}">Отмена</a>

        </form>

    </form>


@endsection

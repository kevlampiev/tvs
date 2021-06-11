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
                <input type="text"
                       class="{{$errors->has('name')?'form-control is-invalid':'form-control'}}"
                       id="inputType" placeholder="Введите название типа" name="name"
                       value="{{$type->name}}">
            </div>
            @if($errors->has('name'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('name') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <button type="submit" class="btn btn-primary">
                @if ($type->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.vehicleTypes')}}">Отмена</a>

        </form>

    </form>


@endsection

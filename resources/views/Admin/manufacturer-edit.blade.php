@extends('layouts.admin')

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
                <input type="text"
                       class="{{$errors->has('name')?'form-control is-invalid':'form-control'}}"
                       id="inputType" placeholder="Введите название производителя"
                       name="name"
                       value="{{$manufacturer->name}}">
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
                @if ($manufacturer->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.manufacturers')}}">Отмена</a>

        </form>

    </form>


@endsection

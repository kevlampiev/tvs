@extends('layouts.admin')

@section('title')
    Администратор|Редактирование типа
@endsection

@section('content')

    <h3> @if (isset($vehicleType->id)) Изменение типа @else Добавить новый тип @endif</h3>
    <form action="{{route($route, ['vehicleType'=>$vehicleType])}}" method="POST">

        @csrf
        <div class="form-group">
            <label for="inputType">Наименование типа</label>
            <input type="text"
                   class="{{$errors->has('name')?'form-control is-invalid':'form-control'}}"
                   id="inputType" placeholder="Введите название типа" name="name"
                   value="{{$vehicleType->name}}">
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
            @if ($vehicleType->id)  Изменить @else Добавить @endif
        </button>
        <a class="btn btn-secondary" href="{{route('admin.vehicleTypes')}}">Отмена</a>


    </form>


@endsection

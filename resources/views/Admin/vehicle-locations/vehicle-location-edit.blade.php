@extends('layouts.admin')

@section('title')
    Администратор|Редактирование локации
@endsection

@section('content')
    <h3> @if ($location->id) Редактирование местонахождения техники @else Добавить новое местонахождение @endif</h3>
    <form method="POST" action="{{$route}}">
        @csrf
        <form>

            <input type="hidden" id="id" name="id"
                   value="{{$location->id}}">

            <div class="form-group">
                <label for="inputType">Наименование</label>
                <input type="text"
                       class="{{($errors->has('name')?'form-control is-invalid':'form-control')}}"
                       id="inputType" placeholder="Введите название" name="name"
                       value="{{$location->name}}">
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

            <div class="form-group">
                <label for="inputType">Адрес</label>
                <input type="text"
                       class="{{($errors->has('address')?'form-control is-invalid':'form-control')}}"
                       id="inputType" placeholder="Введите адрес местонахождения" name="address"
                       value="{{$location->address}}">
            </div>
            @if($errors->has('address'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('address') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">
                @if ($location->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.locations')}}">Отмена</a>

        </form>

    </form>


@endsection

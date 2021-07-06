@extends('layouts.admin')

@section('title')
    Администратор|Справочники
@endsection

@section('content')
    <h3> @if ($insType->id) Изменение @else Добавить @endif</h3>
    <form action="{{route($route, $insType->id)}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Наименование типа страховки</label>
                <input type="text"
                       @if ($errors->has('name'))
                       class="form-control is-invalid"
                       @else
                       class="form-control"
                       @endif
                       id="inputType" placeholder="Введите название типа" name="name"
                       value="{{$insType->name}}">
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
                @if ($insType->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.insTypes')}}">Отмена</a>

        </form>

    </form>


@endsection

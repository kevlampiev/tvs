@extends('layouts.admin')

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
                <input type="text"
                       class="{{($errors->has('name')?'form-control is-invalid':'form-control')}}"
                       id="inputType" placeholder="Введите название" name="name"
                       value="{{$counterparty->name}}">
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
                <label for="inputType">ИНН</label>
                <input type="text"
                       class="{{($errors->has('inn')?'form-control is-invalid':'form-control')}}"
                       id="inputType" placeholder="Введите ИНН" name="inn"
                       value="{{$counterparty->inn}}">
            </div>
            @if($errors->has('inn'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('inn') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">
                @if ($counterparty->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.counterparties')}}">Отмена</a>

        </form>

    </form>


@endsection

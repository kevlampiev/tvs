@extends('layouts.admin')

@section('title')
    Администратор|Редактирование компании
@endsection

@section('content')
    <h3> @if ($company->id) Редактирование компании @else Добавить новую @endif</h3>
    <form action="{{route($route, ['company'=>$company])}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Наименование</label>
                <input type="text"
                       class="{{($errors->has('name')?'form-control is-invalid':'form-control')}}"
                       id="inputType" placeholder="Введите название" name="name"
                       value="{{$company->name}}">
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
                       value="{{$company->inn}}">
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

            <div class="form-group">
                <label for="inputCode">Код</label>
                <input type="text"
                       class="{{($errors->has('code'))?'form-control is-invalid':'form-control'}}"
                       id="inputCode" placeholder="Введите краткий код" name="code"
                       value="{{$company->code}}">
            </div>
            @if($errors->has('code'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('code') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">
                @if ($company->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.companies')}}">Отмена</a>

        </form>

    </form>


@endsection

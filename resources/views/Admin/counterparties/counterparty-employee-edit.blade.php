@extends('layouts.admin')

@section('title')
    Администратор|Редактирование сотрудника контрагента
@endsection

@section('content')
    <h3> @if ($employee->id) Редактирование сотрудника @else Добавить нового @endif</h3>
    <form method="POST">
        @csrf

            <input type="hidden" name="counterparty_id" value="{{$employee->counterparty_id}}">
            <div class="form-group">
                <label for="name">ФИО</label>
                <input type="text"
                       class="{{($errors->has('name')?'form-control is-invalid':'form-control')}}"
                       id="name" placeholder="Введите ФИО" name="name"
                       value="{{$employee->name}}">
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
                <label for="title">Должность</label>
                <input type="text"
                       class="{{($errors->has('title')?'form-control is-invalid':'form-control')}}"
                       id="title" placeholder="Введите наименование должности" name="title"
                       value="{{$employee->title}}">
            </div>
            @if($errors->has('title'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('title') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

             <div class="form-group">
                <label for="email">e-mail</label>
                <input type="text"
                       class="{{($errors->has('email')?'form-control is-invalid':'form-control')}}"
                       placeholder="Введите адрес эдлектронной почты"
                       id="email" name="email"
                       value="{{$employee->email}}">
            </div>
            @if($errors->has('email'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('email') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="phone">Контактный телефон</label>
                <input type="text"
                       class="{{($errors->has('phone')?'form-control is-invalid':'form-control')}}"
                       id="phone"
                       name="phone"
                       placeholder="Введите телефон"
                       value="{{$employee->phone}}">
            </div>
            @if($errors->has('phone'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('phone') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="birthday">День рождения</label>
                <input type="date"
                       class="{{($errors->has('birthday')?'form-control is-invalid':'form-control')}}"
                       id="birthday" name="birthday"
                       value="{{$employee->birthday}}">
            </div>
            @if($errors->has('birthday'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('birthday') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="description">Дополнительная информация</label>
                <textarea class="form-control {{$errors->has('description')?'is-invalid':''}}"
                          id="description"
                          rows="13" name="description">{{$employee->description}}</textarea>
            </div>
            @if ($errors->has('description'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('description') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">
                @if ($employee->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary"
               href="{{route('admin.counterpartySummary', ['counterparty' => $employee->counterparty_id])}}">
                Отмена
            </a>



    </form>


@endsection

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

             <div class="form-group">
                <label for="inputType">Почтовый адрес</label>
                <input type="text"
                       class="{{($errors->has('post_adress')?'form-control is-invalid':'form-control')}}"
                       placeholder="Введите почтовый адрес"
                       id="inputType" name="post_adress"
                       value="{{$counterparty->post_adress}}">
            </div>
            @if($errors->has('post_adress'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('post_adress') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="inputType">Руководитель</label>
                <input type="text"
                       class="{{($errors->has('header')?'form-control is-invalid':'form-control')}}"
                       id="inputType" name="header"
                       placeholder="Введите должность и ФИО руководителя"
                       value="{{$counterparty->header}}">
            </div>
            @if($errors->has('header'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('header') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="inputType">Контактный телефон</label>
                <input type="text"
                       class="{{($errors->has('phone')?'form-control is-invalid':'form-control')}}"
                       id="inputType" name="phone"
                       placeholder="+7 (XXX) XXX-XXXX"
                       value="{{$counterparty->phone}}">
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



            <button type="submit" class="btn btn-primary">
                @if ($counterparty->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.counterparties')}}">Отмена</a>

        </form>

    </form>


@endsection
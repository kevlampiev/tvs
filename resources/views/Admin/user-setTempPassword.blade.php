@extends('layouts.admin')

@section('title')
    Администратор|Установка временного пароля
@endsection

@section('content')
    <h3> Установка временного пароля </h3>
    <form action="{{route('admin.setTempPassword', ['user'=>$user])}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputName">Имя пользователя</label>
                <input type="text" class="form-control" id="inputName" placeholder="Введите имя"
                       value="{{$user->name}}" disabled>
            </div>

            <div class="form-group">
                <label for="inputEMail">e-mail</label>
                <input type="email" class="form-control" id="inputEMail" placeholder="name@server.ru"
                       value="{{$user->email}}" disabled>
            </div>

            <div class="form-group">
                <label for="tempPassword">Временный пароль</label>
                <input type="password" class="form-control" id="tempPassword"
                       name="tempPassword">
            </div>


            <button type="submit" class="btn btn-primary">
               Изменить
            </button>
            <a class="btn btn-secondary" href="{{route('admin.users')}}">Отмена</a>

        </form>

    </form>


@endsection

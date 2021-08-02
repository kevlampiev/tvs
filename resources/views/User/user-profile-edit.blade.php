@extends('layouts.app')


@section('content')
    <div class="row justify-content-center">
        <div class="col-mb-8">
            <h3> Редактирование личной информации</h3>
            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label for="inputName">Имя </label>
                    <input type="text" class="form-control" id="inputName" placeholder="Введите имя" name="name"
                           value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="inputEMail">e-mail</label>
                    <input type="email" class="form-control" id="inputEMail" placeholder="name@server.ru" name="email"
                           value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <a class="btn btn-outline-secondary" href="#"> Изменить пароль </a>
                </div>


                <button type="submit" class="btn btn-primary">
                        Изменить информацию
                </button>
                <a class="btn btn-secondary" href="{{session('previous_url',route('home'))}}">Отмена</a>

            </form>
        </div>
    </div>


@endsection

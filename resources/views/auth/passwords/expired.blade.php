@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Изменение пароля</h3>
                <form method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Действующий пароль</label>
                        <input type="password"
                               class="form-control {{($errors->has('current_password'))?'is-invalid':''}}"
                               id="current_password"
                               aria-describedby="emailHelp"
                               name="current_password">
                    </div>
                    @if ($errors->has('current_password'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('current_password') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="new_password" class="form-label">Новый пароль</label>
                        <input type="password"
                               class="form-control {{($errors->has('new_password'))?'is-invalid':''}}"
                               id="password" name="new_password">
                    </div>
                    @if ($errors->has('new_password'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('new_password') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Новый пароль еще раз</label>
                        <input type="password"
                               class="form-control {{($errors->has('confirm_password'))?'is-invalid':''}}"
                               id="confirm_password" name="confirm_password">
                    </div>
                    @if ($errors->has('confirm_password'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('confirm_password') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                    <a class="btn btn-outline-secondary" href="{{url()->previous()}}">Отмена</a>
                    {{--                    <button type="reset" class="btn btn-outline-secondary">Отмена</button>--}}

                </form>

            </div>
        </div>
    </div>
@endsection

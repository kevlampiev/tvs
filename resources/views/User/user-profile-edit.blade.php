@extends('layouts.app')


@section('content')
    <div class="row justify-content-center">
        <div class="col-mb-8">
            <h3> Редактирование личной информации</h3>
            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label for="inputName">Имя </label>
                    <input type="text"
                           class="{{($errors->has('name')?'form-control is-invalid':'form-control')}}"
                           id="inputName" placeholder="Введите имя" name="name"
                           value="{{$user->name}}">
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
                    <label for="inputEMail">e-mail</label>
                    <input type="email"
                           class="{{($errors->has('email')?'form-control is-invalid':'form-control')}}"
                           id="inputEMail" placeholder="name@server.ru" name="email"
                           value="{{$user->email}}">
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
                    <label for="inputPhone">Номер телефона</label>
                    <input type="tel"
                           class="{{($errors->has('phone_number')?'form-control is-invalid':'form-control')}}"
                           id="inputPhone" name="phone_number"
                           placeholder="(XXX)-XXX-XXXX"
                           value="{{$user->phone_number}}"
                           >
                </div>
                @if($errors->has('phone_number'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('phone_number') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <a class="btn btn-outline-secondary" href="{{route('password.expired')}}"> Изменить пароль </a>
                </div>


                <button type="submit" class="btn btn-primary">
                        Изменить информацию
                </button>
                <a class="btn btn-secondary" href="{{session('previous_url',route('home'))}}">Отмена</a>

            </form>
        </div>
    </div>


@endsection

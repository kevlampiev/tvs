@extends('layouts.admin')

@section('title')
    Администратор| Пользователи
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
        <h2>Пользователи системы</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <a class="btn btn-outline-info" href="{{route('admin.addUser')}}">Добавить пользователя</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Имя</th>
                    <th scope="col">e-mail</th>
                    <th scope="col">Роль</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>
                            <a href="{{route('admin.userSummary', ['user' => $user])}}"> &#9776;Карточка </a>
                        </td>
                        <td>
                            <a href="{{route('admin.editUser', ['user' => $user])}}"> &#9998;Изменить </a>
                        </td>
                        <td> @if (Auth::user()->id!==$user->id)
                                <a href="{{route('admin.setTempPassword',['user' => $user])}}"> &#9998;Сменить
                                    пароль </a>
                            @else
                                <a href="{{route('password.expired')}}"> &#9998;Сменить пароль </a>
                            @endif
                        </td>
                        <td>
                            @if (Auth::user()->id!==$user->id)
                                <a href="{{route('admin.deleteUser', ['user' => $user])}}"
                                   onclick="return confirm('Действительно удалить данные о пользователе?')"> &#10008;Удалить </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <td colspan="6">Нет записей</td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

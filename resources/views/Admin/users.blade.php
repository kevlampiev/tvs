@extends('layouts.admin')

@section('title')
    Администратор| Пользователи
@endsection

@section('content')

    <div class="row">
        <h2>Пользователи системы</h2>
    </div>

    <div class="row">
        <a class="btn btn-outline-info" href="{{route('admin.addUser')}}">Добавить пользователя</a>
    </div>

    <div class="row">
        <div class="col-md-2">
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
                </tr>
                </thead>
                <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <th scope="row">{{$index}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td><a href="{{route('admin.editUser', ['user' => $user])}}"> &#9998;Изменить </a>
                        </td>
                        <td><a href="#"> &#9998;Сменить пароль </a>
                        </td>
                        <td><a href="{{route('admin.deleteUser', ['user' => $user])}}"> &#10008;Удалить </a>
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

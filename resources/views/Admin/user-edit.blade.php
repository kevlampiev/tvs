@extends('layouts.admin')

@section('title')
    Администратор|Редактирование пользователя
@endsection

@section('content')
    <h3> @if ($user->id) Изменение пользователя@else Добавление пользователя @endif</h3>
    <form action="{{route($route, $user->id)}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputName">Имя пользователя</label>
                <input type="text" class="form-control" id="inputName" placeholder="Введите имя" name="name"
                       value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="inputEMail">e-mail</label>
                <input type="email" class="form-control" id="inputEMail" placeholder="name@server.ru" name="email"
                       value="{{$user->email}}">
            </div>

            @php  $roles = ['admin', 'user', 'manager']; @endphp
            <div class="form-group">
                <label for="inputRole">Роль</label>
                <select name="role" class="form-control "
                    {{Auth::user()->id===$user->id?'disabled':''}}>
                    @foreach ($roles as $role)
                        <option
                            value="{{$role}}" {{($role == $user->role) ? 'selected' : ''}}>
                            {{$role}}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                @if ($user->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.users')}}">Отмена</a>

        </form>

    </form>


@endsection

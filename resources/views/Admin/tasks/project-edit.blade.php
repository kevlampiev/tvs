@extends('layouts.admin')

@section('title')
    Администратор|Редактирование данных о проекте
@endsection

@section('content')
    <h3> @if ($task->id) Изменение параметров проекта @else Открыть новый проект @endif</h3>
    <form action="{{$task->id?route('admin.editProject', $task->id):route('admin.addProject')}}" method="POST" enctype="multipart/form-data">
        @csrf


        <div class="row">
            <div class="col-md-10">

                <input type="hidden" name="user_id" value="{{$task->user_id}}">
                <!-- Поле ввода имени задачи -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="subject">Название проекта</span>
                    <input type="text"
                           class="form-control {{$errors->has('subject')?'is-invalid':''}}"
                           aria-describedby="subject"
                           placeholder="Введите название проекта" name="subject"
                           value="{{$task->subject}}">
                </div>
                @if ($errors->has('subject'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('subject') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <!-- Поля ввода срока проекта -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="start_date">Срок исполнения</span>
                    <input type="date"
                           class="form-control {{$errors->has('start_date')?'is-invalid':''}}"
                           aria-describedby="start_date"
                           placeholder="Дата начала" name="start_date"
                           value="{{\Carbon\Carbon::parse($task->start_date)->toDateString()}}">
                    <input type="date"
                           class="form-control {{$errors->has('due_date')?'is-invalid':''}}"
                           aria-describedby="due_date"
                           placeholder="Дата завершения" name="due_date"
                           value="{{\Carbon\Carbon::parse($task->due_date)->toDateString()}}">
                </div>
                @if ($errors->has('start_date'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('start_date') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($errors->has('due_date'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('due_date') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            <!-- Поле ввода дополнительной информации -->
                <div class="form-group">
                    <label for="description">Дополнительная информация</label>
                    <textarea class="form-control {{$errors->has('description')?'is-invalid':''}}"
                              id="description"
                              rows="6" name="description">{{$task->description}}</textarea>
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


            <!-- Поле ввода исполнителя -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Руководитель проекта</span>
{{--                    <select name="task_performer_id"--}}
{{--                            class="form-control selectpicker {{$errors->has('user_id')?'is-invalid':''}}"--}}
{{--                            aria-describedby="basic-addon1"--}}
{{--                            data-live-search="true">--}}
                    <select name="task_performer_id"
                        class="form-control {{$errors->has('user_id')?'is-invalid':''}}"
                        aria-describedby="basic-addon1"
                        data-live-search="true">
                        @foreach ($users as $user)
                        <option
                            value="{{$user->id}}" {{($user->id == $task->task_performer_id) ? 'selected' : ''}}>
                            {{$user->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('task_performer_id'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('task_performer_id') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>

        <div class="mt-10">
            <button type="submit" class="btn btn-primary">
                @if ($task->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{session('previous_url', route('admin.projects'))}}">Отмена</a>
        </div>
    </form>


@endsection

@section('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>



@endsection

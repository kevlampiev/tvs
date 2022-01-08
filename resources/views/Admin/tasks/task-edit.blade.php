@extends('layouts.admin')

@section('title')
    Администратор|Редактирование данных о задаче
@endsection

@section('content')
    <h3> @if ($task->id) Изменение задачи @else Добавить новую задачу @endif</h3>
    <form action="{{route($route, $task->id)}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="user_id" value="{{$task->user_id}}">

        <div class="row">
            <div class="col-md10">

                <!-- Поле ввода имени задачи -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="subject">Формулировка задачи</span>
                    <input type="text"
                           class="form-control {{$errors->has('subject')?'is-invalid':''}}"
                           aria-describedby="subject"
                           placeholder="Введите название задачи" name="subject"
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

            <!-- Полле ввода родительской задачи -->

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Родительская задача</span>
                    <select name="parent_task_id"
                            class="form-control {{$errors->has('parent_task_id')?'is-invalid':''}}"
                            aria-describedby="basic-addon1">
                        @foreach ($tasks as $parentTask)
                            <option
                                value="{{$parentTask->id}}" {{($parentTask->id == $task->parent_task_id) ? 'selected' : ''}}>
                                {{$parentTask->subject}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('parent_task_id'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('parent_task_id') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif



            <!-- Поля ввода срока исполнения задачи -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="start_date">Срок исполнения</span>
                    <input type="date"
                           class="form-control {{$errors->has('start_date')?'is-invalid':''}}"
                           aria-describedby="start_date"
                           placeholder="Дата начала" name="start_date"
                           value="{{$task->start_date}}">
                    <input type="date"
                           class="form-control {{$errors->has('due_date')?'is-invalid':''}}"
                           aria-describedby="due_date"
                           placeholder="Дата завершения" name="due_date"
                           value="{{$task->due_date}}">
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

            <!-- Поле ввода уровня важности -->

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Важность</span>
                    <select name="importance"
                            class="form-control {{$errors->has('importance')?'is-invalid':''}}"
                            aria-describedby="basic-addon1">
                        @foreach ($importances as $key=>$importance)
                            <option
                                value="{{$key}}" {{($key == $task->importance) ? 'selected' : ''}}>
                                {{$importance}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('importance'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('importance') as $error)
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
                    <span class="input-group-text" id="basic-addon1">Исполнитель задачи</span>
                    <select name="task_performer_id"
                            class="form-control {{$errors->has('user_id')?'is-invalid':''}}"
                            aria-describedby="basic-addon1">
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


        <button type="submit" class="btn btn-primary">
            @if ($task->id)  Изменить @else Добавить @endif
        </button>
        <a class="btn btn-secondary" href="{{session('previous_url', route('admin.tasks'))}}">Отмена</a>

    </form>


@endsection

@section('scripts')
    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
            $('#img-viewer').attr('src', e.target.result);
            $('#pts_tmp_path').attr('value', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputGroupFile01").change(function() {
        readURL(this);
    });



    </script>
@endsection


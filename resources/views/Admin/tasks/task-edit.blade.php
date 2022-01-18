@extends('layouts.admin')

@section('title')
    Администратор|Редактирование данных о задаче
@endsection

@section('content')
    <h3> @if ($task->id) Изменение задачи @else Добавить новую задачу @endif</h3>
    <form action="{{$task->id?route('admin.editTask', $task->id):route('admin.addTask')}}" method="POST" enctype="multipart/form-data">
        @csrf


        <div class="row">
            <div class="col-md-10">

                <input type="hidden" name="user_id" value="{{$task->user_id}}">
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

            <!-- Поле ввода родительской задачи -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Родительская задача</span>
                    <select name="parent_task_id"
                            class="form-control selectpicker {{$errors->has('parent_task_id')?'is-invalid':''}}"
                            aria-describedby="basic-addon1"
                            data-live-search="true"
                    >
                        <option value="" {{(!$task->parent_task_id) ? 'selected' : ''}}>  </option>
                        @foreach ($tasks as $parentTask)
                            <option
                                value="{{$parentTask->id}}"
                                {{($parentTask->id == $task->parent_task_id) ? 'selected' : ''}}
                            >
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
                            class="form-control selectpicker {{$errors->has('user_id')?'is-invalid':''}}"
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

                <details>
                    <summary >
                        Дополнительные поля
                    </summary>
                    <!-- Связанный договор -->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Связанный договор</span>
                        <select name="agreement_id"
                                class="form-control selectpicker {{$errors->has('agreement_id')?'is-invalid':''}}"
                                aria-describedby="basic-addon1"
                                data-live-search="true">
                            <option value="" {{!$task->agreement_id?'selected':''}}>  </option>
                            @foreach ($agreements as $agreement)
                                <option
                                    value="{{$agreement->id}}" {{($agreement->id == $task->agreement_id) ? 'selected' : ''}}>
                                    {{$agreement->name}} № {{$agreement->agr_number}} от {{$agreement->date_open}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('agreement_id'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('agreement_id') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <!-- Связанная единица техники -->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Связанная единица техники</span>
                        <select name="vehicle_id"
                                class="form-control selectpicker {{$errors->has('vehicle_id')?'is-invalid':''}}"
                                aria-describedby="basic-addon1"
                                data-live-search="true">
                            <option value="" {{!$task->vehicle_id?'selected':''}}>  </option>
                            @foreach ($vehicles as $vehicle)
                                <option
                                    value="{{$vehicle->id}}" {{($vehicle->id == $task->vehicle_id) ? 'selected' : ''}}>
                                    {{$vehicle->name}}, VIN: {{$vehicle->vin}}, бортовой № {{$vehicle->bort_number}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('vehicle_id'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('vehicle_id') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <!-- Связанная компания -->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Связанная компания группы</span>
                        <select name="company_id"
                                class="form-control selectpicker {{$errors->has('company_id')?'is-invalid':''}}"
                                aria-describedby="basic-addon1"
                                data-live-search="true">
                            <option value="" {{!$task->company_id?'selected':''}}>  </option>
                            @foreach ($companies as $company)
                                <option
                                    value="{{$company->id}}" {{($company->id == $task->company_id) ? 'selected' : ''}}>
                                    {{$company->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('company_id'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('company_id') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <!-- Связанный контрагент -->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Связанный контрагент</span>
                        <select name="counterparty_id"
                                class="form-control selectpicker {{$errors->has('counterparty_id')?'is-invalid':''}}"
                                aria-describedby="basic-addon1"
                                data-live-search="true">
                            <option value="" {{!$task->counterparty_id?'selected':''}}>  </option>
                            @foreach ($counterparties as $counterparty)
                                <option
                                    value="{{$counterparty->id}}" {{($counterparty->id == $task->counterparty_id) ? 'selected' : ''}}>
                                    {{$counterparty->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('counterparty_id'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('counterparty_id') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif



                </details>

            </div>
        </div>

        <div class="mt-10">
            <button type="submit" class="btn btn-primary">
                @if ($task->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{session('previous_url', route('admin.tasks'))}}">Отмена</a>
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

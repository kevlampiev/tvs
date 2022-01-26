@extends('layouts.admin')

@section('title')
    Администратор| Карточка задачи
@endsection

@section('content')

    <div class="row">

        <div class="col-md-11">
        <h2>Карточка задачи </h2>
        </div>
        <div class="col-md-1">
            <a href="{{url()->previous()}}">
                <button type="button" class="btn-close" aria-label="Close"></button>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h4>Основная информация</h4>
            <div class="card bg-light p-3">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="text-right">Формулировка</td>
                            <td class="text-monospace
                                    {{$task->importance=='high'?'text-danger':''}}
                                    {{$task->importance=='low'?'text-secondary':''}}
                                "> <i> {{$task->subject}} </i></td>
                        </tr>

                        <tr>
                            <td class="text-right">Сроки исполнения</td>
                            <td class="text-monospace"> <i> {{\Carbon\Carbon::parse($task->start_date)->format('d.m.Y')}} -
                                {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}</i></td>
                        </tr>
                        <tr>
                            <td class="text-right">Постановщик задачи</td>
                            <td class="text-monospace"> <i>{{$task->user->name}} </i></td>
                        </tr>
                        <tr>
                            <td class="text-right">Дополнительная информация</td>
                            <td class="text-monospace"> <i>{{$task->description}} </i></td>
                        </tr>
                        @if($task->parent_task_id)
                            <tr>
                                <td class="text-right">Родительская задача</td>
                                <td class="text-monospace"> <i><a href="{{route('admin.taskCard', ['task' => \App\Models\Task::find($task->parent_task_id)])}}">
                                        {{\App\Models\Task::find($task->parent_task_id)->subject}}
                                        </a> </i></td>
                            </tr>
                        @endif
                        @if($task->vehicle_id)
                            <tr>
                                <td class="text-right">Связаная единица техники</td>
                                <td class="text-monospace">
                                    <i><a href="{{route('admin.vehicleSummary', ['vehicle' => $task->vehicle])}}">
                                            {{$task->vehicle->vehicleType->name}}
                                            {{$task->vehicle->name}},
                                            VIN:{{$task->vehicle->vin}},
                                            Бортовой номер: {{$task->vehicle->bort_number}}
                                    </i>
                                </td>
                            </tr>
                        @endif
                        @if($task->agreement_id)
                            <tr>
                                <td class="text-right">Связаный договор</td>
                                <td class="text-monospace">
                                    <i><a href="{{route('admin.agreementSummary', ['agreement' => $task->agreement])}}">
                                            {{$task->agreement->name}}
                                            № {{$task->agreement->agr_number}},
                                            от{{$task->agreement->date_open}}, <br>
                                            Стороны по договору: {{$task->agreement->company->name}}, {{$task->agreement->counterparty->name}} </i>
                                </td>
                            </tr>
                        @endif
                        @if($task->counterparty_id)
                        <tr>
                            <td class="text-right">Связанный контрагент</td>
                            <td class="text-monospace"><i> {{$task->counterparty->name}} </i></td>
                        </tr>
                        @endif
                        @if($task->company_id)
                            <tr>
                                <td class="text-right">Связанная компания группы</td>
                                <td class="text-monospace"><i> {{$task->company->name}} </i></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <h4>Дочерние задачи</h4>
            <div class="card bg-light p-3">
                @forelse($task->subTasks as $el)
                    <div>
                        <div class="pl-2 mb-2">
                            <h5>
                                <a href="{{route('admin.taskCard', ['task' => $el])}}">
                                    {{$el->subject}}
                                </a>
                            </h5>
                            <p class="text-secondary"><i>Срок исполнения: {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}</i></p>
                        </div>

                    </div>
                @empty
                    <i>Нет дочерних задач</i>
                @endforelse

            </div>
        </div>

        <div class="col-md-6">
            <h4>Сообщения</h4>
            <div class="card bg-light p-3">
                <nav class="nav">
                    <a class="btn btn-outline-info" aria-current="page" href="{{route('admin.addTaskMessage', ['task'=>$task])}}">Новое сообщение</a>
                </nav>
                <div>
                    @include('Admin.messages.messages', ['messages' => $task->messages])
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-outline-info" href="{{route('admin.tasks')}}"> К полному списку задач </a>

        </div>
    </div>

@endsection


@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <style>
        summary::-webkit-details-marker {
            display: none
        }

        summary:before {
            /*background: url(some-picture);*/
            float: left;
            /*height: 20px;*/
            width: 10px;
            content: "+";
        }

        details[open]>summary:before {
            /*background: url(other-picture);*/
            content: "-";
        }

    </style>

@endsection

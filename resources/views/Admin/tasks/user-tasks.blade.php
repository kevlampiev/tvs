@extends('layouts.admin')

@section('title')
    Администратор| Задачи пользователя
@endsection

@section('content')

    <div class="row">
        <h2>Мои задачи</h2>
        <div class="col-md-12">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="assignedToMe">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Задачи, где я - исполнитель <span class="badge badge-secondary">{{count($userAssignments)}}</span>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="assignedToMe" data-parent="#accordion">
                        <div class="card-body">
                            @forelse($userAssignments as $task)
                                <div class="card" >
                                    <a href="{{route('admin.taskCard', ['task' => $task])}}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$task->subject}}</h5>
                                        <p class="card-text font-italic text-secondary">{{$task->description}}</p>
                                        <div class="text-right text-dark"> Срок исполнения: {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}  Поставил задачу: {{$task->user->name}}</div>
                                    </div>
                                    </a>
                                </div>

                            @empty
                                <i>Нет задач </i>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="myAssignments">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Назначенные мной <span class="badge badge-secondary">{{count($assignedByUser)}}</span>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="myAssignments" data-parent="#accordion">
                        <div class="card-body">
                            @forelse($assignedByUser as $task)
                                <div class="card" >
                                    <div class="card-body bg-light">
                                        <h5 class="card-title">{{$task->subject}}</h5>
                                        <p class="card-text font-italic text-secondary">{{$task->description}}</p>
                                        <div class="text-right text-dark"> Срок исполнения: {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}  Поставил задачу: {{$task->user->name}}</div>
                                    </div>
                                </div>

                            @empty
                                <i>Нет задач </i>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>




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

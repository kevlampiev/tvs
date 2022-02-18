@extends('layouts.admin')

@section('title')
    Администратор| Задачи
@endsection

@section('content')

    <div class="row">
        <h2>Проекты </h2>
    </div>

    <div class="row">
        <div class="col-mb-2">
            <a class="btn btn-outline-info" href="{{route('admin.addProject')}}">Начать новый проект</a>
        </div>
    </div>

    <div class="row">

            @foreach($tasks as $task)
            <div class="col-md-3 m-3 shadow">
                <div class="card m-3" onclick="document.location.href = '{{route('admin.taskCard', ['task' => $task])}}';">
                    <div class="card-body ">
                        <h4 class="card-title">{{$task->subject}}</h4>
                        <p class="card-text project-card p-4">{{$task->description}}</p>
                    </div>
                    @if($task->user==\Illuminate\Support\Facades\Auth::user())
                        <a href="{{route('admin.editProject', ['task' => $task])}}" class="btn btn-outline-secondary">Изменить параметры проекта</a>
                    @endif
                </div>
            </div>
            @endforeach
    </div>


@endsection

@section('styles')
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}

{{--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>--}}
{{--    <!-- Latest compiled and minified CSS -->--}}
{{--    <link rel="stylesheet"--}}
{{--          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">--}}

{{--    <!-- Latest compiled and minified JavaScript -->--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>--}}
    <style>
        .has-child {
            margin: 2px;
            padding: 2px;
            border-bottom: 1px solid #d0d0d0;
            border-right: 1px solid #d0d0d0;
            border-top: 1px solid #ddd;
            border-left: 1px solid #ddd;
            background-color: #f0f0f0;
            position: relative;
            height: 31px;
        }

        .no-childs {
            margin: 2px;
            padding: 2px;
            padding-left: 19px;
            border-bottom: 1px solid #d0d0d0;
            border-right: 1px solid #d0d0d0;
            border-top: 1px solid #ddd;
            border-left: 1px solid #ddd;
            background-color: #f0f0f0;
            position: relative;
            height: 31px;
        }

        .buttons-block {
            position: absolute;
            right: 0;
            top: 0;
            margin-right: 20px;
        }

        .buttons-block a {
            text-decoration: none;
        }

        .importance-high {
            color: darkred;
            font-weight: 800;
        }

        .importance-low {
            color: #6c757d;
        }

        .terminated-task {
            color: #6c757d;
            text-decoration: line-through;
        }
         .project-card {
             height: 150px;
             overflow-y: hidden;
         }
    </style>

@endsection

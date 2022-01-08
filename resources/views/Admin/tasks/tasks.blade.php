@extends('layouts.admin')

@section('title')
    Администратор| Задачи
@endsection

@section('content')

    <div class="row">
        <h2>Задачи </h2>
    </div>

    <div class="row">
        <div class="col-mb-2">
            <a class="btn btn-outline-info" href="{{route('admin.addTask')}}">Добавить новую задачу</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
{{--            @dd($hideClosedTasks)--}}
            @foreach($tasks as $task)

                @if(count(collect($task->subTasks($hideClosedTasks)))>0)
                    <details>
                        <summary class="has-child">
                                @include('Admin.tasks.task-record')
                        </summary>
                        <div class="ml-5">
                            @if(count(collect($task->subTasks($hideClosedTasks)))>0)
                                @include('Admin.tasks.subtasks',['subtasks' => $task->subTasks])
                            @endif
                        </div>

                    </details>
                @else
                    <p class="no-childs">{{$task->subject}} </p>
                @endif

            @endforeach

        </div>
    </div>


@endsection

@section('styles')
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

    </style>

@endsection

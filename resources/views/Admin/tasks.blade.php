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
            <a class="btn btn-outline-info" href="{{route('admin.addInsuranceCompany')}}">Добавить новую</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @foreach($tasks as $task)
                @if(count($task->subTasks)>0)
                    <details>
                        <summary>{{$task->subject}}</summary>
                        <div class="ml-5">
                            @if(count($task->subTasks))
                                @include('Admin.subtasks',['subtasks' => $task->subTasks])
                            @endif
                        </div>

                    </details>
                @else
                    {{$task->subject}}
                @endif

            @endforeach

        </div>
    </div>


@endsection

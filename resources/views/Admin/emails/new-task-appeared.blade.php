@extends('layouts.mail')

@section('content')

    <div class="container">
        <div class="card p-6 p-lg-10 space-y-4">
            <h3>
                Вам поставлена новая задача
            </h3>

            <h2>{{$task->subject}}</h2>
            <p>
                Постановщик задачи: {{$task->user->name}} <br>
                Срок исполнения: {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}
            </p>
            <a class="anchor-btn" href="{{route('admin.taskCard', ['task' => $task])}}">Перейти к задаче</a>
        </div>

    </div>

@endsection

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
            <div class="border-dark bg-light p-4 mb-4">
                <h4>Основная информация</h4>
                @include('Admin.tasks.components.commom-info-menu')
                @include('Admin.tasks.components.common-info-data')
            </div>

            <div class="border-dark bg-light p-4 mb-4">
                <h4>Дочерние задачи</h4>
                @include('Admin.tasks.components.subtasks-menu')
                @include('Admin.tasks.components.subtasks-data')
            </div>
        </div>

        <div class="col-md-6 border-dark bg-light p-4 mb-4">
            <h4>Сообщения</h4>
            @include('Admin.tasks.components.messages-menu')
            <div class="card bg-light">
                @include('Admin.messages.messages', ['messages' => $task->messages])
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

        details[open] > summary:before {
            /*background: url(other-picture);*/
            content: "-";
        }

    </style>

@endsection
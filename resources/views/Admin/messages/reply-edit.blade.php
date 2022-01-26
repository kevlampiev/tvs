@extends('layouts.admin')

@section('title')
    Администратор|Сообщение
@endsection

@section('content')
    <h3> @if ($message->id) Изменение сообщения @else Новое сообщение @endif</h3>
    <form
{{--        action="{{$message->id?route('admin.editMessage', ['message' => $message]):route('admin.messageReply', ['message' => $message])}}"--}}
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-10">
            <h4>ответ на сообщение: </h4>
            <input type="hidden" name="user_id" value="{{$message->user_id}}">
            <input type="hidden" name="reply_to_message_id" value="{{$message->reply_to_message_id}}">

            <!-- Поле ввода описания -->
                <div class="form-group">
{{--                    <label for="description">Текс сообщения</label>--}}
                    <textarea class="form-control {{$errors->has('description')?'is-invalid':''}}"
                              id="description"
                              rows="6" name="description">{{$message->description}}</textarea>
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

            </div>
        </div>

        <div class="mt-10">
            <button type="submit" class="btn btn-primary">
                @if ($message->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{url()->previous()}}">Отмена</a>
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

{{--Сообщения для разных форм будет разные => и пути азные на кнопки добавления --}}
{{--    <div class="row">--}}
{{--        <div class="col-mb-2">--}}
{{--            <a class="btn btn-outline-info" href="{{route('admin.addTask')}}">Добавить новую задачу</a>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="row">
        <div class="col-md-12">
            @foreach($messages as $message)

                @if(count(collect($message->replies))>0)
                    <details open>
                        <summary>
                            @include('Admin.messages.message-record')
                        </summary>
                        <div class="ml-5">
                            @include('Admin.messages.message-record',['messages' => $message->replies])
                        </div>

                    </details>
                @else
                    @include('Admin.messages.message-record')
                @endif

            @endforeach

        </div>
    </div>


{{--Сообщения для разных форм будет разные => и пути азные на кнопки добавления --}}
{{--    <div class="row">--}}
{{--        <div class="col-mb-2">--}}
{{--            <a class="btn btn-outline-info" href="{{route('admin.addTask')}}">Добавить новую задачу</a>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="row">
        <div class="col-md-12">
            @foreach($messages->where('reply_to_message_id', '=' ,null) as $message)
                @if(count(collect($message->replies))>0)
                    <details open>
                        <summary class="ml-2">
                            @include('Admin.messages.message-record')
                        </summary>
                        <div class="ml-5">
                            @include('Admin.messages.replies',['replies' => $message->replies])
                        </div>

                    </details>
                @else
                    <div class="ml-2">
                        @include('Admin.messages.message-record')
                    </div>
                @endif

            @endforeach

        </div>
    </div>


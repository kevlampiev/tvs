@foreach($replies as $message)
    @if(count($message->replies)>0)
        <details>
            <summary class="has-child">
                @include('Admin.messages.message-record')
            </summary>
            <div class="ml-5">
                @include('Admin.messages.replies', ['replies' => $message->replies])
            </div>
        </details>
    @else
        <div class="no-childs">
            @include('Admin.messages.message-record')
        </div>
    @endif

@endforeach

<span >
    <span class="small">
        {{$message->user->name}}  {{\Carbon\Carbon::parse($message->created_at)->format('d.m.Y h:s')}}
    </span>
    <span class="text-secondary font-italic ml-3">
            {{$message->description}}
    </span>
    <a href="#">Ответить</a>
</span>

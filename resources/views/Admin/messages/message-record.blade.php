<div>
    <span class="fs-6 text-secondary fw-lighter">
        {{$message->user->name}}  {{\Carbon\Carbon::parse($message->created_at)->format('d.m.Y h:s')}}
    </span>
    <span class="font-italic ml-3">
            {{$message->description}}
    </span>
    <a href="{{route('admin.messageReply', ['message'=>$message])}}">
        <i class="fa fa-reply" aria-hidden="true"></i>
    </a>
</div>

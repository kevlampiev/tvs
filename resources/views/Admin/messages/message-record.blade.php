<div class="border-start border-4 m-2 p-2">
    <div class="border-bottom pl-4">
        <span class="fs-6 text-secondary fw-lighter">
            {{$message->user->name}}  {{\Carbon\Carbon::parse($message->created_at)->format('d.m.Y h:s')}}
        </span>
        <span class="font-italic ml-3">
                {!! $message->description !!}
        </span>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{route('admin.messageReply', ['message'=>$message])}}" class="btn btn-outline-secondary">
            <i class="fa fa-reply" aria-hidden="true"></i> Ответить
        </a>
        @if($message->user->id == Auth::user()->id)
            <a href="{{route('admin.messageEdit', ['message'=>$message])}}" class="btn btn-outline-secondary">
                <i class="bi bi-pencil"></i>  Изменить
            </a>
            @if(count($message->replies)==0)
                <a href="{{route('admin.messageDelete', ['message'=>$message])}}"
                   onclick="return confirm('Вы действительно хотите удалить это сообщение?')"
                   class="btn btn-outline-secondary">
                    <i class="bi bi-trash"></i> Удалить
                </a>
            @endif
        @endif
    </div>
</div>

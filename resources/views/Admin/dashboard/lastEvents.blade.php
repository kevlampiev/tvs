@if (count(auth()->user()->unreadNotifications)>0)
    <a class="position-absolute top-0 end-0 btn btn-sm btn-info" href="{{route('markAllNotificationsAsRead')}}"> Пометить все как прочитанные </a>
@endif

<div>
    @forelse(auth()->user()->notifications->take(15) as $el)

        <div class="p-2 m-1 {{!$el->read_at?'border border-info font-weight-bold':'border border-light text-muted'}}" >
            <a href="{{route('readNotification', ['id' => $el->id] )}}"> {{$el->data['subject']}} </a>
            <i>От пользователя {{$el->data['sender']??"Anonymous "}} {{\Carbon\Carbon::parse($el->created_at)->format('d.m.Y h:m')}} <i>

        </div>

    @empty
        список уведомлений пуст
    @endforelse

</div>

<div>
    @forelse(auth()->user()->unreadNotifications as $index=>$el)
        <div class="note-block">
            <p>
                <strong>{{$el->subject}}  </strong>
            </p>
        </div>

    @empty
        нет событий
    @endforelse

</div>

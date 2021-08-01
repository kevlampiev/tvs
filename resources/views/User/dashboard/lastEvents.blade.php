<div>
    @forelse($notes as $index=>$el)
        <div class="note-block">
            <p>
                <strong>{{$el->user->name}} {{$el->created_at}} </strong>
                {{$el->note_body}}
            </p>
        </div>

    @empty
        нет событий
    @endforelse

</div>

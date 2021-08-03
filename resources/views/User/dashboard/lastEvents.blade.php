<div>
    @forelse($notes as $index=>$el)
        <div class="note-block">
            <p>
                <strong>{{$el->user->name}} {{$el->created_at}} </strong>
                <br>
                по единице техники {{$el->vehicle->name}}<br>
                <i>{{$el->note_body}}</i>
            </p>
        </div>

    @empty
        нет событий
    @endforelse

</div>

<div class="row m-1">
    <div class="col-md-12">
    <a class="btn btn-outline-info" href="{{route('admin.addAgreementNote', ['agreement'=>$agreement])}}">Добавить заметку</a>

<div class="notes-container">

    @forelse($agreement->notes as $index=>$note)
        <div class="card mb-3">
            <div class="card-header">
                <strong> {{$note->user->name}} </strong>    {{$note->created_at}}
            </div>
            <div class="card-body">
                <p>{{$note->note_body}}</p>
            </div>
            @if($note->user_id === Auth::user()->id)
                <div class="card-footer text-muted">
                    <a href="{{route('admin.editAgreementNote', ['agreementNote'=>$note])}}" class="mr-5"> &#9998;Изменить </a>
                    <a href="{{route('admin.deleteAgreementNote', ['agreementNote' => $note])}}"
                       onclick="return confirm('Действительно удалить заметку?')"> &#10008;Удалить </a>
                </div>
            @endif
        </div>
    @empty
        <p class="font-italic text-secondary">Нет заметок по договору</p>
    @endforelse

</div>

    </div>
</div>

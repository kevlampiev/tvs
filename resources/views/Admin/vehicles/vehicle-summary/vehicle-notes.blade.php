<div class="row m-1">
    <div class="col-md-12">
    <a class="btn btn-outline-info" href="{{route('admin.addVehicleNote', ['vehicle'=>$vehicle])}}">Добавить заметку</a>


<div class="notes-container">

    @forelse($notes as $index=>$note)
        <div class="card mb-3">
            <div class="card-header">
                <strong> {{$note->user->name}} </strong>    {{\Carbon\Carbon::parse($note->created_at)->format('d.m.Y')}}
            </div>
            <div class="card-body">
                <p>{{$note->note_body}}</p>
            </div>
            @if($note->user_id === Auth::user()->id)
                <div class="card-footer text-muted">
                    <a href="{{route('admin.editVehicleNote', ['vehicleNote'=>$note])}}" class="mr-5"> &#9998;Изменить </a>
                    <a href="{{route('admin.deleteVehicleNote', ['vehicleNote' => $note])}}"
                       onclick="return confirm('Действительно удалить заметку?')"> &#10008;Удалить </a>
                </div>
            @endif
        </div>
    @empty
        <h4>Нет заметок по данной единице техники</h4>
    @endforelse

</div>
    </div>
</div>

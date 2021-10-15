<div class="row m-1">
{{--    <a class="btn btn-outline-primary"--}}
{{--       href="{{route('admin.addVehicleDocument',['vehicle'=>$vehicle])}}" >--}}
{{--        Добавить документ--}}
{{--    </a>--}}
</div>

<div class="file-info-container">

    @forelse($agreement->documents as $index=>$document)
    <div class="card m-2" style="width: 18rem;">
        <div class="card-body">
            <a
                href="{{route('admin.documentPreview', ['document'=>$document] ) }}"
            >
                <i class="bi bi-file-earmark-bar-graph"> - {{$index}}</i>
                <p class="card-text clr-gray mb-2 p-2">{{$document->description}}</p>
            </a>
            <a href="{{route('admin.editAgreementDocument', ['document'=>$document])}}" class="m-2" >&#9998;Изменить</a>
            <a href="{{route('admin.deleteDocument', ['document'=>$document])}}" class="m-2" onclick="return confirm('Действиетльно удалить запись?')">&#10008;Удалить</a>
        </div>
    </div>

    @empty
        <p>Нет документов для отображения</p>
    @endforelse
</div>

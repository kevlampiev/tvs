

<div class="file-info-container">

    @forelse($agreement->documents as $index=>$document)
    <div class="card m-2" style="width: 18rem;">
        <div class="card-body">
            <a
                href="{{route('admin.documentPreview', ['document'=>$document] ) }}"
                class="text-dark">
                <img src="{{asset(\File::extension($document->file_name).'.png')}}" style="width: 25px;">
                <p class="card-text clr-gray mb-2 p-2">{{$document->description}}</p>
            </a>
            <a href="{{route('admin.editAgreementDocument', ['document'=>$document])}}"
               class="m-2 btn btn-outline-secondary" >
                &#9998;Изменить
            </a>
            <a href="{{route('admin.deleteDocument', ['document'=>$document])}}" class="m-2 btn btn-outline-secondary"
               onclick="return confirm('Действиетльно удалить запись?')">
                &#10008;Удалить
            </a>
        </div>
    </div>

    @empty
        <p>Нет документов для отображения</p>
    @endforelse
</div>



<div class="card bg-light p-3">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Тип файла</th>
            <th scope="col">Описание</th>
            <th scope="col">Опубликован</th>
            <th scope="col">Изменен</th>
            <th scope="col">Автор</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>

            @forelse($task->documents as $document)

                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td >
                        <img src="{{asset(\File::extension($document->file_name).'.png')}}" style="width: 25px;">
                    </td>
                    <td >
                        <a href="{{route('admin.documentPreview', ['document'=>$document] ) }}">
                            {{$document->description}}
                        </a>
                    </td>
                    <td class="small text-secondary font-italic">{{Carbon\Carbon::parse($document->created_at)->format('d.m.y h:m')}}</td>
                    <td class="small text-secondary font-italic">{{Carbon\Carbon::parse($document->updated_at)->format('d.m.y h:m')}}</td>
                    <td class="small text-secondary font-italic">{{$document->user->name}}</td>
                    <td>
                        @if($document->user_id==Auth::user()->id)
                            <a href="{{route('admin.editDocument', ['document' => $document])}}">
                            &#9998;Изменить </a>
                        @endif
                    </td>
                    <td>
                        @if($document->user_id==Auth::user()->id)
                            <a href="{{route('admin.deleteDocument', ['document' => $document])}}"
                            onclick="return confirm('Действительно удалить {{$document->file_name}} из базы?')">&#10008;Удалить</a>
                        @endif
                    </td>
                </tr>

            @empty
                <td colspan="3" class="font-italic">
                    Задача не имеет документов
                </td>
            @endforelse
        </tbody>
    </table>
</div>

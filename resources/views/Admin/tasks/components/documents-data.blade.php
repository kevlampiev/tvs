

<div class="card bg-light p-3">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Описание документа</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>

            @forelse($task->documents as $document)

                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td >
                        <a href="{{route('admin.documentPreview', ['document'=>$document] ) }}">
                            {{$document->description}}
                        </a>
                    </td>
                    <td>Изменить</td>
                    <td>Удалить</td>
                </tr>

            @empty
                <td colspan="3" class="font-italic">
                    Задача не имеет документов
                </td>
            @endforelse
        </tbody>
    </table>
</div>

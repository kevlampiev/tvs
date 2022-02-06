<div class="row m-1">
    <div class="col-md-12">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">#</th>
                <th scope="col">Задача</th>
                <th scope="col">Исполнитель</th>
                <th scope="col">Срок исполнения</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($counterparty->tasks->where('terminate_date', '=', null) as $task)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>#{{$task->id}}</td>
                    <td>{{$task->subject}}</td>
                    <td>{{$task->performer->name}}</td>
                    <td>{{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}</td>
                    <td>
                        <a href="{{route('admin.taskCard', ['task' => $task])}}">
                            &#9776;Карточка
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <th colspan="4" class="text-secondary font-italic">Нет задач по контрагенту</th>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

<div class="row m-1">
    <div class="col-md-12">

        <table class="table">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">ФИО</th>
                <th scope="col">Должность</th>
                <th scope="col">Телефон</th>
                <th scope="col">E-mail</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($counterparty->staff as $employee)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>#{{$employee->name}}</td>
                    <td>{{$employee->title}}</td>
                    <td>{{$employee->phone}}</td>
                    <td>{{$employee->email}}</td>
                    <td>
{{--                        <a href="{{route('admin.taskCard', ['task' => $task])}}">--}}
{{--                            &#9776;Карточка--}}
{{--                        </a>--}}
                    </td>
                </tr>
            @empty
                <tr>
                    <th colspan="4" class="text-secondary font-italic">Нет данных для отображения</th>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

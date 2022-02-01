<div class="card bg-white">
    <table class="table">
        <tbody>
        <tr>
            <td class="text-right">Название проекта</td>
            <td class="text-monospace
                                    {{$task->importance=='high'?'text-danger':''}}
            {{$task->importance=='low'?'text-secondary':''}}
                "><i> {{$task->subject}} </i></td>
        </tr>

        <tr>


        <tr>
            <td class="text-right">Срок проекта</td>
            <td
                class="text-monospace @if(($task->due_date<\Carbon\Carbon::now())&&(!$task->terminate_date))
                                           text-danger
                                        @elseif((\Carbon\Carbon::parse($task->due_date)->diffInDays(now())<3)&&(!$task->terminate_date))
                                           text-warning
                                        @endif
                    ">
                <i> {{\Carbon\Carbon::parse($task->start_date)->format('d.m.Y')}} -
                    {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}</i>
            </td>
        </tr>


        <tr>
            <td class="text-right">Руководитель проекта</td>
            <td class="text-monospace"><i>{{$task->performer->name}} </i></td>
        </tr>
        <tr>
            <td class="text-right">Дополнительная информация</td>
            <td class="text-monospace"><i>{{$task->description}} </i></td>
        </tr>

        </tbody>
    </table>
</div>

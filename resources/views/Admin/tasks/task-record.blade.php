<div class="mt-3">
    <a href="{{route('admin.taskCard', ['task' => $task])}}"
        @if(count($task->subTasks)==0)
        class="ml-3"
        @endif>
            # {{$task->id}}   {{$task->subject}}
                <span class="text-secondary small font-italic"> Исп:{{$task->performer->name}}
                        &nbsp; Срок:{{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}

                </span>
    </a>
</div>

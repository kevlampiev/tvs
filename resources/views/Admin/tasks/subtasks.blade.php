@foreach($subtasks as $task)
    @if(count($task->subTasks)>0)
        <details>
            <summary class="has-child">
                @include('Admin.tasks.task-record')
            </summary>
            <div class="ml-5">
                @include('Admin.tasks.subtasks', ['subtasks' => $task->subTasks])
            </div>
        </details>
    @else
        <p class="no-childs">
            @include('Admin.tasks.task-record')
        </p>
    @endif

@endforeach

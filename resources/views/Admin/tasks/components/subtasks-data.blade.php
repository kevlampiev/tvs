<div class="card bg-light p-3">
    @forelse($task->subTasks as $el)
        <div>
            <div class="pl-2 mb-2">
                <h5>
                    @if(count($el->subTasks)==0)
                        @include('Admin.tasks.task-record', ['task' => $el])
                    @else
                        <details>
                            <summary>
                                @include('Admin.tasks.task-record', ['task' => $el])
                            </summary>
                            <div class="ml-3">
                                @include('Admin.tasks.subtasks', ['subtasks' =>$el->subTasks])
                            </div>
                        </details>
                    @endif
                </h5>

            </div>

        </div>
    @empty
        <i>Нет дочерних задач</i>
    @endforelse
</div>

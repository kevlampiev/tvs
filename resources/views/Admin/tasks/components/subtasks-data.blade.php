<div class="card bg-light p-3">
    @forelse($task->subTasks as $el)
        <div>
            <div class="pl-2 mb-2">
                <h5>
                    @if(count($task->subTasks)==0)
                        <a href="{{route('admin.taskCard', ['task' => $el])}}">
                            {{$el->subject}}
                        </a>
                    @else
                        <details>
                            <summary>
                                <a href="{{route('admin.taskCard', ['task' => $el])}}">
                                    {{$el->subject}}
                                </a>
                            </summary>
                            <div class="ml-3">
                                @include('Admin.tasks.subtasks', ['subtasks' =>$task->subTasks])
                            </div>
                        </details>
                    @endif
                </h5>
                <p class="text-secondary"><i>Срок
                        исполнения: {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}</i></p>
            </div>

        </div>
    @empty
        <i>Нет дочерних задач</i>
    @endforelse
</div>

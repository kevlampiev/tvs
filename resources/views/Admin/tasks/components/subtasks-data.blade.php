<div class="card bg-light p-3">
    @forelse($task->subTasks as $el)
        <div>
            <div class="pl-2 mb-2">
                <h5>
                    <a href="{{route('admin.taskCard', ['task' => $el])}}">
                        {{$el->subject}}
                    </a>
                </h5>
                <p class="text-secondary"><i>Срок
                        исполнения: {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}</i></p>
            </div>

        </div>
    @empty
        <i>Нет дочерних задач</i>
    @endforelse
</div>

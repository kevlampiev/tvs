
@forelse($tasks as $task)
    <div>
        <a href="{{route('admin.taskCard', ['task'=>$task])}}">{{$task->subject}} </a>
    </div>
@empty
    <div class="text-secondary text-center">Список пуст</div>
@endforelse

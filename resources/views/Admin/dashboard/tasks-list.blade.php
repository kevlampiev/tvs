
@forelse($tasks as $task)
    <div>
        <a href="{{route('admin.taskCard', ['task'=>$task])}}" class="text-dark font-italic">{{$task->subject}} </a>
        <span class="small text-secondary">срок {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}
            Постановщик: {{$task->user->name}}</span>
    </div>
@empty
    <div class="text-secondary text-center">Список пуст</div>
@endforelse

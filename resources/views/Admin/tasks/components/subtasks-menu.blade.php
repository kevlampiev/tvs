@if($task->user==Auth::user()||$task->performer==Auth::user())
    <nav class="nav">
        <a class="btn btn-outline-info" aria-current="page"
           href="{{route('admin.addSubTask', ['parentTask'=>$task])}}">Новая дочерняя задача</a>
    </nav>
@endif

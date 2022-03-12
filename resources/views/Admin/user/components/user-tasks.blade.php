<div class="row m-1">
    <div class="col-md-12">

        <div class="notes-container">
            @forelse($user->tasks->where('date_close','=',null) as $index=>$task)
                @include('Admin.tasks.task-record')
            @empty
                <p class="font-italic text-secondary">У пользователя нет актуальных задач</p>
            @endforelse
        </div>

    </div>
</div>

<div class="row m-1">
    <div class="col-md-12">

        <div class="notes-container">
            @forelse($agreement->tasks as $index=>$task)
                @include('Admin.tasks.task-record')
            @empty
                <p class="font-italic text-secondary">Нет актуальных задач по договору</p>
            @endforelse
        </div>

    </div>
</div>

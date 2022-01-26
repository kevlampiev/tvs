@if($task->user==Auth::user())
    <div class="btn-group" role="group" aria-label="Basic outlined example">
        <a class="btn btn-outline-info" href="{{route('admin.editTask', ['task' => $task])}}">Редактировать</a>

        @if(!$task->terminate_date)
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-outline-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Завершить задачу
                </button>
                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <li><a class="dropdown-item text-decoration-line-through"
                           href="{{route('admin.markTaskAsCanceled', ['task'=> $task])}}">Отменить</a></li>
                    <li><a class="dropdown-item text-success"
                           href="{{route('admin.markTaskAsDone', ['task'=> $task])}}">Выполнить</a></li>
                </ul>
            </div>
        @else
            <a class="btn btn-outline-info"
               href="{{route('admin.markTaskAsRunning', ['task' => $task])}}">
                Возобновить задачу
            </a>
        @endif

        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Изменить приоритет
            </button>
            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <li><a class="dropdown-item text-secondary" href="#">Низкий</a></li>
                <li><a class="dropdown-item" href="#">Обычный</a></li>
                <li><a class="dropdown-item text-danger" href="#">Высокий</a></li>
            </ul>
        </div>
    </div>
@endif

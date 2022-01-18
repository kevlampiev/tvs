<span @if($task->importance=='high')
        class="importance-high"
      @elseif($task->importance=='low')
        class="importance-low"
      @endif
      @if($task->terminate_date)
        class="terminated-task"
      @endif
>

    {{$task->subject}}
        <small><i> &nbsp; Исп:{{$task->performer->name}}
                &nbsp; Срок:{{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}
            </i>
        </small>

        <span class="buttons-block">
            <div class="btn-group">
                  <button class="btn btn-outline-secondary btn-sm" type="button">
                       Управление задачей
                  </button>
                  <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="visually-hidden">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                        <li><a href="#"> Добавить дочернюю</a></li>
                        @if($task->user_id === Auth::user()->id)
                            <li><a href="{{route('admin.editTask', ['task' => $task])}}" > Изменить</a></li>
                            <li><a href="{{route('admin.markTaskAsDone', ['task' => $task])}}"
                                   onclick="return confirm('Действительно отметить задачу и все дочерние задачи как завершенные?')"> Завершить</a></li>
                            <li><a href="{{route('admin.markTaskAsCanceled', ['task' => $task])}}"
                                   onclick="return confirm('Это действие отменит задачу, а таке все дочерние задачи. Продолжить?')"> Снять задачу</a></li>
                      @endif

                  </ul>
            </div>


{{--            <a href="#"> &#8853; Дочерняя</a>--}}
{{--            @if($task->user_id === Auth::user()->id)--}}
{{--                <a href="{{route('admin.editTask', ['task' => $task])}}" > &#9998; Изменить</a>--}}
{{--                <a href="#"> &#10003; Завершить</a>--}}
{{--            @endif--}}
        </span>




</span>
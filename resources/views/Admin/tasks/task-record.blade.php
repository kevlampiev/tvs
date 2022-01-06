<span @if($task->importance=='high')
        class="importance-high"
      @elseif($task->importance=='low')
        class="importance-low"
      @endif>
    {{$task->subject}}
        <small><i> &nbsp; Исп:{{$task->performer->name}}
                &nbsp; Срок:{{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}
            </i>
        </small>
        <span class="buttons-block">
            <a href="#" > &#9998; Изменить</a>
            <a href="#"> &#8853; Дочерняя</a>
            <a href="#"> &#10003; Завершить</a>
        </span>
</span>

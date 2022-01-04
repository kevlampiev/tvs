@foreach($subtasks as $subtask)
    @if(count($subtask->subTasks)>0)
        <details>
            <summary>{{$subtask->subject}}</summary>
            <div class="ml-5">
                @include('Admin.subtasks', ['subtasks' => $subtask->subTasks])
            </div>
        </details>
    @else
        {{$subtask->subject}}
    @endif

@endforeach

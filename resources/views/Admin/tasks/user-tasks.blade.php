@extends('layouts.admin')

@section('title')
    Администратор| Задачи пользователя
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h2>Мои задачи</h2>
        </div>
        <div class="col-md-4">
            <form class="form-inline my-2 my-lg-0" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск в моих задачах" aria-label="Search" name="searchStr"
                       value="{{isset($filter)?$filter:''}}">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Поиск</button>
            </form>
        </div>

    </div>

    <div class="row">

        <div class="col-md-6">
            <h5 class="mt-2">Задачи, поставленные передо мной</h5>
            <table class="table ">
                                <thead>
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">Арт</th>
                                    <th scope="col">Формулировка</th>
                                    <th scope="col">Срок исполнения</th>
                                    <th scope="col">Постановщик задачи</th>
                                </tr>

                                </thead>
                                <tbody>
                                    @forelse($userAssignments as $task)
                                       <tr
                                           @if($task->importance=='high')
                                            class="table-danger"
                                           @endif
                                           @if($task->importance=='low')
                                            class="table-secondary"
                                           @endif
                                       >
                                           <th class="text-center">
                                                {{$loop->index +1 }}
                                           </th>
                                           <td class="text-secondary small mr-3">
                                               #{{$task->id}}
                                           </td>
                                           <td >
                                               <a href="{{route('admin.taskCard', ['task' => $task])}}">
                                                   {{$task->subject}}
                                               </a>
                                           </td>

                                           <td
                                               class="text-monospace
                                                    @if(($task->due_date<\Carbon\Carbon::now())&&(!$task->terminate_date))
                                                        text-danger
                                                    @elseif((\Carbon\Carbon::parse($task->due_date)->diffInDays(now())<3)&&(!$task->terminate_date))
                                                        text-warning
                                                    @else
                                                        text-secondary small
                                                    @endif
                                                   ">
                                               до {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}
                                           </td>


                                           <td class="text-secondary small mr-3">
                                               {{$task->user->name}}
                                           </td>
                                       </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-secondary font-italic">
                                                Нет задач для отображение
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
        </div>

        <div class="col-md-6">
            <h5 class="mt-2">Задачи, поставленные мною другим сотрудникам</h5>
            <table class="table table-secondary">
                <thead>
                <th scope="col">№</th>
                <th scope="col">Арт</th>
                    <th scope="col">Формулировка</th>
                    <th scope="col">Срок исполнения</th>
                    <th scope="col">Исполнитель</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                @forelse($assignedByUser as $task)
                    <tr class="{{$task->importance=='medium'?'table-light':''}}{{$task->importance=='high'?'table-danger':''}}">
                        <th>
                            {{$loop->index}}
                        </th>
                        <td class="text-secondary small mr-3">
                            #{{$task->id}}
                        </td>
                        <td>
                            <a href="{{route('admin.taskCard', ['task' => $task])}}">
                                {{$task->subject}}
                            </a>
                        </td>
                        <td
                            class="text-monospace
                                    @if(($task->due_date<\Carbon\Carbon::now())&&(!$task->terminate_date))
                                        text-danger
                                    @elseif((\Carbon\Carbon::parse($task->due_date)->diffInDays(now())<3)&&(!$task->terminate_date))
                                        text-warning
                                    @else
                                        text-secondary small
                                    @endif
                                ">
                            до {{\Carbon\Carbon::parse($task->due_date)->format('d.m.Y')}}
                        </td>
                        <td class="text-secondary small mr-3">
                            {{$task->performer->name}}
                        </td>
                        <td>

                        </td>
                   </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-secondary font-italic">
                            Нет задач для отображение
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

    </div>

@endsection

@extends('layouts.admin')

@section('title')
    Администратор| Поиск по базе данных
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
        <h2>Результаты поиска {{$globalSearchStr}}</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
                @forelse($searchResults as $index=>$el)
                    <div class="shadow-sm m-3 p-2 ">
                        @switch($el->entity_type)
                                  @case('task')
                                        <a class="text-decoration-none text-secondary font-weight-bold" href="{{route('admin.taskCard', ['task'=>$el->id])}}">Задача</a>
                                        @break
                                  @case('agreement')
                                        <a class="text-decoration-none text-secondary font-weight-bold" href="{{route('admin.agreementSummary', ['agreement'=>$el->id])}}">Договор</a>
                                          @break
                                  @case('vehicle')
                                        <a class="text-decoration-none text-secondary font-weight-bold" href="{{route('admin.vehicleSummary', ['vehicle'=>$el->id])}}">Техника</a>
                                          @break
                                  @case('message')
                                        @if ($el->id)
                                            <a class="text-decoration-none text-secondary font-weight-bold" href="{{route('admin.taskCard', ['task'=>$el->id])}}">Сообщение</a>
                                        @else
                                            Сообщение
                                        @endif
                                          @break
                                  @case('vehicle_none')
                                        <a class="text-decoration-none text-secondary font-weight-bold"
                                           href="{{route('admin.vehicleSummary', ['vehicle'=>$el->id, 'page' =>'notes'])}}">
                                            Заметка по технике
                                        </a>
                                          @break
                                  @case('agreement_none')
                                        <a class="text-decoration-none text-secondary font-weight-bold"
                                           href="{{route('admin.agreementSummary', ['agreement'=>$el->id, 'page' =>'notes'])}}">
                                            Заметка по договору
                                        </a>
                                          @break
                                  @case('employee')
                                        <a class="text-decoration-none text-secondary font-weight-bold"
                                           href="{{route('admin.counterpartySummary', ['counterparty'=>$el->id])}}">
                                            Сотрудник контрагента
                                        </a>
                                          @break
                                  @case('document')
                                            <a class="text-decoration-none text-secondary font-weight-bold"
                                               href="{{route('admin.documentPreview', ['document'=>$el->id])}}">
                                                Документ
                                            </a>
                                          @break
                                  @default Прочее
                        @endswitch

                        <p>
                            {!! $el->entity_text !!}
                        </p>
                    </div>
                @empty
                    <p>Нет записей</p>
                @endforelse

                    {!! $searchResults->appends(request()->input())->links() !!}
        </div>
    </div>
@endsection

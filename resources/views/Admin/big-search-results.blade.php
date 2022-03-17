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
                                          Сообщение
                                          @break
                                  @case('vehicle_none')
                                          Заметка
                                          @break
                                  @case('agreement_none')
                                          Заметка
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
                </tbody>
            </table>
        </div>
    </div>
@endsection

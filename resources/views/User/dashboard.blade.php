@extends('layouts.app')


@section('content')
    {{--    @dd($data)--}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    <h3>Предстояшие платежи (14 дней) </h3>
                    <div class="dashBoardEl">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Компания</th>
                                <th scope="col">Просрочено, млн.руб</th>
                                <th scope="col">Срочные платежи, млн.руб</th>
                                <th scope="col">Всего, млн.руб</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $key=>$el)
                            <tr>
                                <td>{{$key}}</td>
                                <td class="text-right">{{number_format(($el->sum('overdue'))/1000000,1)}}</td>
                                <td class="text-right">{{number_format(($el->sum('nearestPayments'))/1000000,1)}}</td>
                                <td class="text-right">{{number_format(($el->sum('overdue')+$el->sum('nearestPayments'))/1000000,1)}}</td>
                            </tr>
                            @empty
                                <td colspan="3">Нет записей</td>
                            @endforelse
                            <tr>
                                <th>Всего</th>
                                <th class="text-right">{{number_format(($summary->totalOverdue)/1000000,1)}}</th>
                                <th class="text-right">{{number_format(($summary->totalNearest)/1000000,1)}}</th>
                                <th class="text-right">{{number_format(($summary->totalOverdue+$summary->totalNearest)/1000000,1)}}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right mt-md-3">
                        <a href="{{route('user.nearestPayments')}}">Подробнее...</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda consequatur, distinctio expedita modi placeat temporibus velit. Incidunt itaque obcaecati rerum!
                </div>
                <div class="shadow p-3 mb-5 bg-white rounded dashBoardBlock">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, quam similique. Aperiam enim facere libero.
                </div>

            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .dashBoardBlock {
            height: 350px;
            overflow-y: scroll;
            }
        .dashBoardEl {
            height: 240px;
            overflow-y: scroll;
        }
    </style>
@endsection

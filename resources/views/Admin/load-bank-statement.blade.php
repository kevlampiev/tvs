@extends('layouts.admin')

@section('title')
    Администратор|Загрузка выписки 1С
@endsection

@section('content')
    <div class="jumbotron">
        <h3>Загрузка выписки 1С</h3>
        <form action="{{route('admin.preProcessBankStatement')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Загрузка банковской выписки</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                           aria-describedby="inputGroupFileAddon01" name="file1C">
                    <label class="custom-file-label" for="inputGroupFile01">Выберите файл</label>

                </div>
                <button type="submit" class="btn btn-outline-primary ml-5">Загрузить выбранный файл для анализа </button>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Плательщик</th>
                    <th scope="col">Получатель</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Основание</th>
                    <th scope="col">Номер и дата договора</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($bankStatementPositions as $index=>$item)
                    <tr {{$item->agreement_id?'':'class=text-secondary'}}>
                        <th scope="row">{{$index + 1}}</th>
                        <td>{{$item->date_open}}</td>
                        <td>{{$item->payer}}</td>
                        <td>{{$item->receiver}}</td>
                        <td>{{number_format($item->amount,2)}}</td>
                        <td>{{$item->description}}</td>
                        <td class="text-center">
                            @if($item->agreement_id)
                                {{$item->agr_number}} от {{$item->agr_date}}
                            @else
                                ---
                            @endif
                        </td>
                        <td></td>
                    </tr>
                @empty
                    <p>Нет записей</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="jumbotron">
        <form method="POST" action="{{route('admin.transferToRealPayments')}}">
            @csrf
            <button type="submit" class="btn btn-outline-primary">Перенести обратботанные позиции в платежи </button>
        </form>
    </div>

@endsection

@extends('layouts.admin')

@section('title')
    Администратор|Загрузка выписки 1С
@endsection

@section('content')
    <div class="jumbotron">
        <h3>Загрузка выписки 1С</h3>
        <form action="{{route('admin.preProcessBankStatement')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="file-input" name="file1C" onchange="activateLoadBtn()">
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit"
                            class="btn btn-outline-primary ml-5"
                            id="loadBtn" disabled>
                        Загрузить выбранный файл для анализа 	&dArr;
                    </button>
                </div>
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

@section('scripts')
    <script>
        function activateLoadBtn()
        {
            alert(1)
            let loadBtn=document.querySelector('#loadBtn')
            loadBtn.removeAttribute("disabled")
        }
    </script>

@endsection


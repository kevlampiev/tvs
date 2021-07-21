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
                </tr>
                </thead>
                <tbody>
                @forelse($bankStatementPositions as $index=>$bankStatementPosition)
                    <tr {{$bankStatementPosition->agreement_id?'':'class=text-secondary'}}>
                        <th scope="row">{{$index + 1}}</th>
                        <td>{{$bankStatementPosition->date_open}}</td>
                        <td>{{$bankStatementPosition->payer}}</td>
                        <td>{{$bankStatementPosition->receiver}}</td>
                        <td>{{number_format($bankStatementPosition->amount,2)}}</td>
                        <td>{{$bankStatementPosition->description}}</td>
                        <td class="text-center">
                            @if($bankStatementPosition->agreement_id)
                                {{$bankStatementPosition->agr_number}} от {{$bankStatementPosition->agr_date}}
                            @else
                                ---
                            @endif
                        </td>
                        <td> @if($bankStatementPosition->agreement_id)
                                <a href="#"> &#10008; Отвязать договор  </a>
                             @else
                                <a href="{{route('admin.attachAgrToBS',['bankStatementPosition'=>$bankStatementPosition->id])}}"> &#10004; Привязать договор </a>
                             @endif
                        </td>
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
            <button type="submit"
                    class="btn btn-outline-primary"
            {{($bankStatementPositions->count()>0)?'':'disabled'}}>
                Перенести обратботанные позиции в платежи
            </button>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        function activateLoadBtn()
        {
            let loadBtn=document.querySelector('#loadBtn')
            loadBtn.removeAttribute("disabled")
        }
    </script>

@endsection


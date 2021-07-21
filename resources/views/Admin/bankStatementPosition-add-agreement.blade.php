@extends('layouts.admin')

@section('title')
    Администратор|Привязать договор к платежу
@endsection

@section('content')
    <h3> Привязать договор к платежу </h3>

    <p> Дата: {{$bankStatementPosition->date_open}}</p>
    <p> Плательщик: {{$bankStatementPosition->payer}}</p>
    <p> Получатель: {{$bankStatementPosition->receiver}}</p>
    <p> Сумма: {{$bankStatementPosition->amount}}</p>
    <p> Основание платежа: {{$bankStatementPosition->decription}}</p>
    <form method="POST">
        @csrf
        <div class="input-group mb-3">
            <label for="agreements"></label>
            <select name="agreement_id" class="form-control selectpicker" id="agreements" data-live-search="true">
                @foreach ($agreements as $agreement)
                    <option>
{{--                        value="{{$agreement->id}}" {{($agreement->id == $agreement->company_id) ? 'selected' : ''}}>--}}
                        {{$agreement->name}} {{$agreement->agr_number}} компания:{{$agreement->Company->code}} контрагент:{{$agreement->Counterparty->name}}                       }}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">
            Привязать
        </button>
        <a class="btn btn-secondary" href="{{route('admin.loadBankStatement',[])}}">Отмена</a>


    </form>


@endsection

@section('scripts')
    <script>
        $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: 4
        });
    </script>
@endsection


@section('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-en_US.js"></script>

@endsection

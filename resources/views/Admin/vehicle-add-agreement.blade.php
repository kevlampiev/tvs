@extends('layouts.admin')

@section('title')
    Администратор|Привязать договор к технике
@endsection

@section('content')
    <h3> Привязать договор к {{$vehicle->name}}</h3>
    <form method="POST">
        @csrf
        <div class="input-group mb-3">
            <label for="agreements"></label>
            <select name="agreement_id" class="form-control selectpicker" id="agreements" data-live-search="true">
                @foreach ($agreements as $agreement)
                    <option
                        value="{{$agreement->id}}" >
                        {{$agreement->agreementType->name}} №{{$agreement->agr_name}} от {{$agreement->date_open}}
                        между {{$agreement->company->name}} и {{$agreement->counterparty->name}}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">
            Добавить
        </button>
        <a class="btn btn-secondary" href="{{route('admin.vehicleSummary',['vehicle'=>$vehicle, 'page'=>'agreements'])}}">Отмена</a>


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

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



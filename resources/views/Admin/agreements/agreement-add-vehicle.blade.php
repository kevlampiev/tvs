@extends('layouts.admin')

@section('title')
    Администратор|Добавить технику к договору
@endsection

@section('content')
    <h3> Добавить техику, приобретаемую по договору {{$agreement->agr_num}} от {{$agreement->date_open}}</h3>
    <form method="POST">
        @csrf
        <div class="row">
            <div class="col-md-11">


                <div class="input-group mb-3">
                    <label for="vehicles"></label>
{{--                    <select name="vehicle_id" class="form-control selectpicker" id="vehicles" data-live-search="true">--}}
                    <select name="vehicle_id" class="form-control" id="vehicles" data-live-search="true">
                        @foreach ($vehicles as $vehicle)
                            <option
                                value="{{$vehicle->id}}" {{($vehicle->id == $agreement->company_id) ? 'selected' : ''}}>
                                {{$vehicle->name}} модель:{{$vehicle->model}} номер:{{$vehicle->bort_number}}
                                VIN:{{$vehicle->vin}}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Добавить
        </button>
        <a class="btn btn-secondary" href="{{route('admin.agreementSummary',['agreement'=>$agreement])}}">Отмена</a>


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

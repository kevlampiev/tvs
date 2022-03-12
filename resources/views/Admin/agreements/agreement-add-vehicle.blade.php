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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#vehicles').select2();
        })
    </script>
@endsection

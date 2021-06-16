@extends('layouts.admin')

@section('title')
    Администратор|Добавить технику к договору
@endsection

@section('content')
    <h3> Добавить техику, приобретаемую по договору {{$agreement->agr_num}} от {{$agreement->date_open}}</h3>
    <form  method="POST">
        @csrf
            <div class="input-group mb-3">
                <label for="vehicles"></label>
                <select name="vehicle_id" class="form-control selectpicker" id="vehicles" data-live-search="true">
                    @foreach ($vehicles as $vehicle)
                    <option
                        value="{{$vehicle->id}}" >
{{--                        value="{{$veicle->id}}" {{($vehicle->id == $agreement->company_id) ? 'selected' : ''}}>--}}
                        {{$vehicle->name}}
                    </option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary">
                Добавить
            </button>
            <a class="btn btn-secondary" href="{{route('admin.agreementSummary',['agreement'=>$agreement])}}">Отмена</a>


    </form>


@endsection

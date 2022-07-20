@extends('layouts.admin')

@section('title')
    Администратор|Установить местонахождение техники
@endsection

@section('content')
    <h3> Установить местонахождение единицы техники {{$placement->vehicle->name}}</h3>
    <form method="POST">
        @csrf
        <input type="hidden" name="vehicle_id" value="{{$placement->vehicle_id}}">

        <div class="input-group mb-3">
            <span class="input-group-text" id="date_open">Дата перевода в локацию</span>
            <input type="date"
                   class="form-control {{$errors->has('date_open')?'is-invalid':''}}"
                   aria-describedby="model"
                   name="date_open"
                   value="{{$placement->date_open}}">
        </div>
        @if ($errors->has('date_open'))
            <div class="alert alert-danger">
                <ul class="p-0 m-0">
                    @foreach($errors->get('date_open') as $error)
                        <li class="m-0 p-0"> {{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="input-group mb-3">
            <label for="locations"></label>
            <select name="location_id"
                    class="form-control selectpicker" id="locations" data-live-search="true">
                @foreach ($locations as $location)
                    <option
                        value="{{$location->id}}"
                        {{($location->id == $placement->location_id) ? 'selected' : ''}}>
                        {{$location->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Комментарий</label>
            <textarea class="form-control {{$errors->has('description')?'is-invalid':''}}"
                      id="description"
                      rows="13" name="description">{{$placement->description}}</textarea>
        </div>
        @if ($errors->has('description'))
            <div class="alert alert-danger">
                <ul class="p-0 m-0">
                    @foreach($errors->get('description') as $error)
                        <li class="m-0 p-0"> {{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <button type="submit" class="btn btn-primary">
            Добавить
        </button>
        <a class="btn btn-secondary" href="{{route('admin.vehicleSummary',['vehicle'=>$placement->vehicle_id, 'page'=>'placements'])}}">Отмена</a>


    </form>


@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#agreements').select2();
        })
    </script>
@endsection



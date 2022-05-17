@extends('layouts.admin')

@section('title')
    Администратор|Аварии техники
@endsection

@section('content')
    <h3> @if ($vehicleIncident->id) Редактирование данных @else Добавить данные об инциденте @endif</h3>
    <form
{{--        @if($vehicleIncident->id)--}}
{{--            action="{{route('admin.editVehicleNote', ['vehicleNote' =>$vehicleNote->id])}}"--}}
{{--        @else--}}
{{--            action="{{route('admin.addVehicleNote', ['vehicle' => $vehicleNote->vehicle->id])}}"--}}
{{--        @endif--}}
        method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Единица техники</label>
                <input type="hidden"
                       id="vehicle_id" name="vehicle_id" value="{{$vehicleIncident->vehicle_id}}">
                <input type="text"
                       id="input-vehicle" name="vehicle" value="{{$vehicleIncident->vehicle->name}}" disabled>
            </div>
            @if ($errors->has('vehicle_id'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('vehicle_id') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="input-group mb-3">
                <span class="input-group-text" id="estimate_date">Дата инцидента</span>
                <input type="date"
                       class="form-control {{$errors->has('date_open')?'is-invalid':''}}"
                       aria-describedby="model"
                       placeholder="Введите дату инцидента" name="date_open"
                       value="{{$vehicleIncident->date_open}}">
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

            <div class="form-group">
                <label for="description">Описание инцидента</label>
                <textarea class="form-control {{$errors->has('description')?'is-invalid':''}}"
                          id="description"
                          rows="13" name="description">{{$vehicleIncident->description}}</textarea>
            </div>
            @if ($errors->has('descrption'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('description') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <button type="submit" class="btn btn-primary">
                @if ($vehicleIncident->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary"
               href="{{route('admin.vehicleSummary',['vehicle'=>$vehicleIncident->vehicle_id, 'page' => 'incidents'])}}">
                Отмена
            </a>

        </form>

    </form>


@endsection

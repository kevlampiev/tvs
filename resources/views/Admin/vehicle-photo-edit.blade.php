@extends('layouts.admin')

@section('title')
    Администратор|Изменение фотографии
@endsection

@section('content')
    <h3> @if ($vehiclePhoto->id) Измнение фотографии @else Добавить фотографию техники @endif</h3>
    <form
        @if($vehiclePhoto->id)
            action="{{route('admin.editVehiclePhoto', ['vehiclePhoto' =>$vehiclePhoto->id])}}"
        @else
            action="{{route('admin.addVehiclePhoto', ['vehicle' => $vehiclePhoto->vehicle])}}"
        @endif
        method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Единица техники</label>
                <input type="hidden"
                       id="vehicle_id" name="vehicle_id" value="{{$vehiclePhoto->vehicle_id}}">
                <input type="text"
                       id="input-vehicle" name="vehicle" value="{{$vehiclePhoto->vehicle->name}}" disabled>
            </div>

            @if($vehiclePhoto->img_file)
                <img src="{{asset(config('paths.vehicles.get','storage/img/vehicles/').$vehiclePhoto->img_file)}}">
            @else
                <img src="{{asset(config('paths.vehicles.get','storage/img/no_image_found.jpg'))}}">
            @endif

            <div class="form-group">
                <label for="description">Комментарий</label>
                <textarea class="form-control {{$errors->has('comment')?'is-invalid':''}}"
                          id="note_body"
                          rows="13" name="note_body">{{$vehiclePhoto->comment}}</textarea>
            </div>
            @if ($errors->has('comment'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('comment') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <button type="submit" class="btn btn-primary">
                @if ($vehiclePhoto->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary"
               href="{{route('admin.vehicleSummary',['vehicle'=>$vehiclePhoto->vehicle_id, 'page' => 'photos'])}}">
                Отмена
            </a>

        </form>

    </form>


@endsection

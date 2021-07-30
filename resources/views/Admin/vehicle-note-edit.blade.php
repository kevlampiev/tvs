@extends('layouts.admin')

@section('title')
    Администратор|Изменение заметки
@endsection

@section('content')
    <h3> @if ($vehicleNote->id) Редактирование заметки @else Добавить заметку @endif</h3>
    <form
        @if($vehicleNote->id)
            action="{{route($route, ['vehicle' => $vehicleNote->vehicle->id, 'vehicleNode' =>$vehicleNote->id])}}"
        @else
            action="{{route('admin.addVehicleNote', ['vehicle' => $vehicleNote->vehicle->id])}}"
        @endif
        method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Единица техники</label>
                <input type="hidden"
                       id="vehicle_id" name="vehicle_id" value="{{$vehicleNote->vehicle_id}}">
                <input type="text"
                       id="input-vehicle" name="vehicle" value="{{$vehicleNote->vehicle->name}}" disabled>
            </div>

            <div class="form-group">
                <label for="description">Текст заметки</label>
                <textarea class="form-control {{$errors->has('note_body')?'is-invalid':''}}"
                          id="note_body"
                          rows="13" name="note_body">{{$vehicleNote->note_body}}</textarea>
            </div>
            @if ($errors->has('note_body'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('note_body') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <button type="submit" class="btn btn-primary">
                @if ($vehicleNote->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.vehicleSummary',['vehicle'=>$vehicleNote->vehicle_id])}}">Отмена</a>

        </form>

    </form>


@endsection

@extends('layouts.admin')

@section('title')
    Администратор|Аварии техники
@endsection

@section('content')
    <h3> @if ($vehicleCondition->id) Редактирование данных @else Добавить данные о состоянии @endif</h3>
    <form method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Единица техники</label>
                <input type="hidden"
                       id="vehicle_id" name="vehicle_id" value="{{$vehicleCondition->vehicle_id}}">
                <input type="text"
                       id="input-vehicle" name="vehicle" value="{{$vehicleCondition->vehicle->name}}" disabled>
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
                <span class="input-group-text" id="estimate_date">Дата установения состояния</span>
                <input type="date"
                       class="form-control {{$errors->has('date_open')?'is-invalid':''}}"
                       aria-describedby="model"
                       placeholder="Введите дату инцидента" name="date_open"
                       value="{{$vehicleCondition->date_open}}">
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

            @php $conditions = \Illuminate\Support\Facades\Config::get('constants.vehicleConditions') @endphp

            <div class="input-group mb-3">
                <span class="input-group-text" id="market_price">Состояние</span>
                <select name="condition" id="condition"
                        class="form-control {{$errors->has('condition')?'is-invalid':''}}">
                    @foreach ($conditions as $key=>$condition)
                        <option value="{{$key}}" {{($key == $vehicleCondition->condition) ? 'selected' : ''}}>
                            {{$condition}}
                        </option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('condition'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('condition') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="description">Комментарий</label>
                <textarea class="form-control {{$errors->has('description')?'is-invalid':''}}"
                          id="description"
                          rows="13" name="description">{{$vehicleCondition->description}}</textarea>
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
                @if ($vehicleCondition->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary"
               href="{{route('admin.vehicleSummary',['vehicle'=>$vehicleCondition->vehicle_id, 'page' => 'conditions'])}}">
                Отмена
            </a>

        </form>

    </form>


@endsection

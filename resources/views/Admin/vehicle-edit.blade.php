@extends('layouts.admin')

@section('title')
    Администратор|Редактирование данных о технике
@endsection

@section('content')
    <h3> @if ($vehicle->id) Изменение описания @else Добавить новую единицу техники @endif</h3>
    <form action="{{route($route, $vehicle->id)}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Тип техники </span>
                    <select name="vehicle_type_id"
                            class="form-control {{$errors->has('vehicle_type_id')?'is-invalid':''}}"
                            aria-describedby="basic-addon1">
                        @foreach ($vehicleTypes as $type)--}}
                        <option
                            value="{{$type->id}}" {{($type->id == $vehicle->vehicle_type_id) ? 'selected' : ''}}>
                            {{$type->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('vehicle_type_id'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('vehicle_type_id') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon2">Производитель</span>
                    <select name="manufacturer_id"
                            class="form-control {{$errors->has('manufacturer_id')?'is-invalid':''}}"
                            aria-describedby="basic-addon2">
                        @foreach ($manufacturers as $manufacturer)
                            <option
                                value="{{$manufacturer->id}}" {{($manufacturer->id == $vehicle->manufacturer_id) ? 'selected' : ''}}>
                                {{$manufacturer->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('manufacturer_id'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('manufacturer_id') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="input-group mb-3">
                    <span class="input-group-text" id="veh-name">Наименование оборудования</span>
                    <input type="text"
                           class="form-control {{$errors->has('name')?'is-invalid':''}}"
                           aria-describedby="veh-name"
                           placeholder="Введите название оборудования" name="name"
                           value="{{$vehicle->name}}">
                </div>
                @if ($errors->has('name'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('name') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="input-group mb-3">
                    <span class="input-group-text" id="vin">Заводской номер/VIN</span>
                    <input type="text"
                           class="form-control {{$errors->has('vin')?'is-invalid':''}}"
                           aria-describedby="vin"
                           placeholder="Введите заводской номер/VIN" name="vin"
                           value="{{$vehicle->vin}}">
                </div>
                @if ($errors->has('vin'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('vin') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="input-group mb-3">
                    <span class="input-group-text" id="bort_number">Бортовой номер</span>
                    <input type="text"
                           class="form-control {{$errors->has('bort_number')?'is-invalid':''}}"
                           aria-describedby="bort_number"
                           placeholder="Введите бортовой номер/ номер госрегистрации" name="bort_number"
                           value="{{$vehicle->bort_number}}">
                </div>
                @if ($errors->has('bort_number'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('bort_number') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="input-group mb-3">
                    <span class="input-group-text" id="prod_year">Год выпуска</span>
                    <input type="number"
                           class="form-control {{$errors->has('prod_year')?'is-invalid':''}}"
                           aria-describedby="prod_year" placeholder="2021"
                           name="prod_year"
                           value="{{$vehicle->prod_year}}">
                </div>
                @if ($errors->has('prod_year'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('prod_year') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="input-group mb-3">
                    <span class="input-group-text" id="trademark">Торговая марка</span>
                    <input type="text"
                           class="form-control {{$errors->has('trademark')?'is-invalid':''}}"
                           aria-describedby="trademark"
                           placeholder="Введите название торговой марки" name="trademark"
                           value="{{$vehicle->trademark}}">
                </div>
                @if ($errors->has('trademark'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('trademark') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="input-group mb-3">
                    <span class="input-group-text" id="model">Модель</span>
                    <input type="text"
                           class="form-control {{$errors->has('model')?'is-invalid':''}}"
                           aria-describedby="model"
                           placeholder="Введите название модели" name="model"
                           value="{{$vehicle->model}}">
                </div>
                @if ($errors->has('model'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('model') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @php $currencies = \Illuminate\Support\Facades\Config::get('constants.currencies') @endphp
                <div class="input-group mb-3">
                    <span class="input-group-text" id="market_price">Стоимость</span>
                    <input type="number" step="0.01" min="0"
                           class="form-control {{$errors->has('price')?'is-invalid':''}}"
                           aria-describedby="market_price"
                           placeholder="Введите цену приобретения" name="price"
                           value="{{$vehicle->price}}">
                    <select name="currency" id="currency"
                            class="form-control {{$errors->has('currency')?'is-invalid':''}}">
                        @foreach ($currencies as $currency)
                            <option value="{{$currency}}" {{($currency == $vehicle->currency) ? 'selected' : ''}}>
                                {{$currency}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('price'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('price') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($errors->has('currency'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('currency') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="input-group mb-3">
                    <span class="input-group-text" id="estimate_date">Дата приобретения</span>
                    <input type="date"
                           class="form-control {{$errors->has('purchase_date')?'is-invalid':''}}"
                           aria-describedby="model"
                           placeholder="Введите дату приобретения" name="purchase_date"
                           value="{{$vehicle->purchase_date}}">
                </div>
                @if ($errors->has('purchase_date'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('purchase_date') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            </div>

            <div class="col-md6 p-3">
                <h4>Изображение ПТС/ПСМ</h4>
                <div class="card" style="width: 18rem;">
                    <img
                        @if($vehicle->pts_img_path)
                            src="{{asset(config('paths.pts.get','storage/img/pts/').$vehicle->pts_img_path)}}" class="card-img-top" alt="..."
                        @else
                            src="{{asset('storage/img/no_image_found.jpeg')}}" class="card-img-top" alt="..."
                        @endif
                        id="img-viewer">
                    <div class="card-body" onclick="document.getElementById('inputGroupFile01').click()">
{{--                        <p class="card-text">Для изменения изображения ПТС/ПСМ кликните на кнопку ниже</p>--}}
                    </div>
                    <a class="btn btn-outline-secondary" onclick="document.getElementById('inputGroupFile01').click()">Изменить изображение</a>
                </div>

                <div class="input-group mb-3">
                    <input type="file" class="form-control-file" id="inputGroupFile01" name="pts-img"
                           accept="image/*" style="display:none">
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">
            @if ($vehicle->id)  Изменить @else Добавить @endif
        </button>
        <a class="btn btn-secondary" href="{{session('previous_url', route('admin.vehicles'))}}">Отмена</a>

    </form>


@endsection

@section('scripts')
    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
            $('#img-viewer').attr('src', e.target.result);
            $('#img-viewer').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputGroupFile01").change(function() {
        readURL(this);
    });

    </script>
@endsection


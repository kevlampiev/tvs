@extends('Admin.layout')

@section('title')
    Администратор|Редактирование данных о технике
@endsection

@section('content')
    <h3> @if ($vehicle->id) Изменение описания @else Добавить новую единицу техники @endif</h3>
    <form action="{{route($route, $vehicle->id)}}" method="POST">
        @csrf


            <div class="row">
                <div class="col-md6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Тип техники </span>
                        <select name="vehicle_type_id" class="form-control" aria-describedby="basic-addon1">
                            @foreach ($vehicleTypes as $type)--}}
                            <option
                                value="{{$type->id}}" {{($type->id == $vehicle->vehicle_type_id) ? 'selected' : ''}}>
                                {{$type->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Производитель</span>
                        <select name="manufacturer_id" class="form-control" aria-describedby="basic-addon2">
                            @foreach ($manufacturers as $manufacturer)
                                <option
                                    value="{{$manufacturer->id}}" {{($manufacturer->id == $vehicle->manufacturer_id) ? 'selected' : ''}}>
                                    {{$manufacturer->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="veh-name">Наименование оборудования</span>
                        <input type="text" class="form-control" aria-describedby="veh-name"
                               placeholder="Введите название оборудования" name="name"
                               value="{{$vehicle->name}}">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="vin">Заводской номер/VIN</span>
                        <input type="text" class="form-control" aria-describedby="vin"
                               placeholder="Введите заводской номер/VIN" name="vin"
                               value="{{$vehicle->vin}}">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="bort_number">Бортовой номер</span>
                        <input type="text" class="form-control" aria-describedby="bort_number"
                               placeholder="Введите бортовой номер/ номер госрегистрации" name="bort_number"
                               value="{{$vehicle->bort_number}}">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="prod_year">Год выпуска</span>
                        <input type="number" class="form-control" aria-describedby="bort_number" placeholder="2021"
                               name="prod_year"
                               value="{{$vehicle->prod_year}}">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="trademark">Торговая марка</span>
                        <input type="text" class="form-control" aria-describedby="trademark"
                               placeholder="Введите название торговой марки" name="trademark"
                               value="{{$vehicle->trademark}}">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="model">Модель</span>
                        <input type="text" class="form-control" aria-describedby="model"
                               placeholder="Введите название модели" name="model"
                               value="{{$vehicle->model}}">
                    </div>

                    @php $currencies = ['RUR', 'USD', 'EUR', 'CNY', 'YPN'] @endphp
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="market_price">Стоимость</span>
                        <input type="number" class="form-control" aria-describedby="market_price"
                               placeholder="Введите цену приобретения" name="price"
                               value="{{$vehicle->price}}">
                        <select name="currency" id="currency" class="form-control">
                            @foreach ($currencies as $currency)
                                <option value="{{$currency}}" {{($currency == $vehicle->currency) ? 'selected' : ''}}>
                                    {{$currency}}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="estimate_date">Дата приобретения</span>
                        <input type="date" class="form-control" aria-describedby="model"
                               placeholder="Введите дату приобретения" name="purchase_date"
                               value="{{$vehicle->purchase_date}}">
                    </div>

                </div>

                <div class="col-md6 p-3">
                    <h4>Изображение ПТС/ПСМ</h4>
                    <div class="card" style="width: 18rem;">
                        <img src="https://pln-pskov.ru/pictures/201124092823.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile01">
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">
                @if ($vehicle->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.vehicles')}}">Отмена</a>

    </form>


@endsection

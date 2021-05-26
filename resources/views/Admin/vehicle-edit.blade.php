@extends('Admin.layout')

@section('title')
    Администратор|Редактирование данных о технике
@endsection

@section('content')
    <h3> @if ($vehicle->id) Изменение описания @else Добавить новую единицу техники @endif</h3>
    <form action="{{route($route, $vehicle->id)}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="type">Тип техники</label>
                <select name="vehicle_type_id" id="type" class="form-control">
                    @foreach ($vehicleTypes as $type)
                        <option value="{{$type->id}}" {{($type->id == $vehicle->vehicle_type_id) ? 'selected' : ''}}>
                            {{$type->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="manufacturer">Производитель</label>
                <select name="manufacturer_id" id="manufacturer" class="form-control">
                    @foreach ($manufacturers as $manufacturer)
                        <option value="{{$manufacturer->id}}" {{($manufacturer->id == $vehicle->manufacturer_id) ? 'selected' : ''}}>
                            {{$manufacturer->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="inputName">Наименование техники</label>
                <input type="text" class="form-control" id="inputName" placeholder="Введите название оборудования" name="name"
                value="{{$vehicle->name}}">
            </div>

            <div class="form-group">
                <label for="inputVin">Заводской номер/VIN</label>
                <input type="text" class="form-control" id="inputVin" placeholder="Введите заводской номер/VIN" name="vin"
                value="{{$vehicle->vin}}">
            </div>

            <div class="form-group">
                <label for="inputBortNo">Бортовой номер</label>
                <input type="text" class="form-control" id="inputBortNo" placeholder="Введите бортовой номер" name="bort_number"
                value="{{$vehicle->bort_number}}">
            </div>

            <div class="form-group">
                <label for="inputProdYear">Год выпуска</label>
                <input type="text" class="form-control" id="inputProdYear" placeholder="2021" name="prod_year"
                value="{{$vehicle->prod_year}}">
            </div>

            <div class="form-group">
                <label for="inputTrademark">Торговая марка</label>
                <input type="text" class="form-control" id="inputTrademark" placeholder="Введите название торговой марки" name="trademark"
                       value="{{$vehicle->trademark}}">
            </div>

            <div class="form-group">
                <label for="inputModel">Наименование модели</label>
                <input type="text" class="form-control" id="inputModel" placeholder="Введите название модели" name="model"
                       value="{{$vehicle->model}}">
            </div>

            <div class="form-group">
                <label for="inputMarketPrice">Рыночная стоимость</label>
                <input type="text" class="form-control" id="inputMarketPrice" placeholder="0.00" name="market_price"
                       value="{{$vehicle->market_price}}">
            </div>


            @php $currencies = ['RUR', 'USD', 'EUR', 'CNY', 'YPN'] @endphp

            <div class="form-group">
                <label for="currency">Валюта</label>
                <select name="currency" id="currency" class="form-control">
                    @foreach ($currencies as $currency)
                        <option value="{{$currency}}" {{($currency == $vehicle->currency) ? 'selected' : ''}}>
                            {{$currency}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="inputEstimationDate">Дата оценки</label>
                <input type="text" class="form-control" id="inputEstimationDate" placeholder="01/01/2021" name="estimate_date"
                       value="{{$vehicle->estimate_date}}">
            </div>

            <button type="submit" class="btn btn-primary">
                @if ($vehicle->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.vehicles')}}">Отмена</a>

        </form>

    </form>


@endsection

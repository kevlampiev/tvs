@extends('Admin.layout')

@section('title')
    Администратор|Параметры договора
@endsection

@section('content')
    <h3>Дополнительные данные по договору {{$agreement->name}} № {{$agreement->agr_number}} от {{$agreement->date_open}}</h3>



    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#additions">Допсоглашения</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#vehicles">Приобретенная техника</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#collaterals">Залог</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#payments">Расчеты</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="additions">
            Описание товара...
        </div>
        <div class="tab-pane fade" id="vehicles">

{{--            @php--}}
{{--                {{$vehicles = $agreement->vehicles}};--}}
{{--            @endphp--}}

            <h4>Техника, приобретаемая по данному договору</h4>
            <div class="row">
                <a class="btn btn-outline-info" href="{{route('admin.agreementAddVehicle', ['agreement'=>$agreement])}}">Добавить единицу техники</a>
            </div>
            @include('Admin.components.vehicles-table')
        </div>
        <div class="tab-pane fade" id="collaterals">
            Отзывы...
        </div>
        <div class="tab-pane fade" id="payments">
            Отзывы...
        </div>

    </div>

@endsection

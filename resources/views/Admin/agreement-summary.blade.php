@extends('Admin.layout')

@section('title')
    Администратор|Карточка договора
@endsection

@section('content')
    <h3>Карточка договора № {{$agreement->agr_number}} от {{$agreement->date_open}}</h3>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#main-info">Основная информация</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#additions">Допсоглашения</a>
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
        <div class="tab-pane fade show active" id="main-info">
            <h4>Основные данные</h4>
            @include('Admin.components.agreement-main')
        </div>

        <div class="tab-pane fade" id="additions">
            Тут будут все допсоглашения
        </div>

        <div class="tab-pane fade" id="vehicles">
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
            @php  $payments = $agreement->payments->sortBy('payment_date'); @endphp
            @php  $realPayments = $agreement->realPayments->sortBy('payment_date'); @endphp
            <div class="row">
                @include('Admin.components.payment-tables')
                @include('Admin.components.real-payment-tables')
            </div>
        </div>

    </div>

@endsection

@section('scripts')
<script>
    function autoSelectPage()
    {
        let urlArr = document.location.pathname.split('/')
        if (urlArr.length===6) {
            let tabName= '[href="#'+urlArr[5] +'"'
            $(tabName).tab('show')
        }
    }

    document.addEventListener("DOMContentLoaded", autoSelectPage);
</script>

@endsection

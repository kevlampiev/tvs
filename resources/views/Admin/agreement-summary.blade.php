@extends('layouts.admin')

@section('title')
    Администратор|Карточка договора
@endsection

@section('content')
    <h3>Карточка договора № {{$agreement->agr_number}} от {{\Carbon\Carbon::parse($agreement->date_open)->format('d.m.Y')}}</h3>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#main-info">Основная информация</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#documents">Файлы/Документы</a>
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
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#notes">Заметки</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="main-info">
            <h4>Основные данные</h4>
            @include('Admin.agreement-summary.agreement-main')
        </div>

        <div class="tab-pane fade" id="documents">
            <h4>Связанные файлы</h4>
            <div class="row m-1">
                <div class="col-md-12">
                <a class="btn btn-outline-primary"
                   href="{{route('admin.addAgreementDocument',['agreement' => $agreement])}}" >
                    Добавить документ
                </a>

                @include('Admin.agreement-summary.agreement-files')
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="vehicles">
            <h4>Техника, приобретаемая по данному договору</h4>
            <div class="row">
                <div class="col-mb-12">
                <a class="btn btn-outline-info"
                   href="{{route('admin.agreementAddVehicle', ['agreement'=>$agreement])}}">Добавить единицу техники</a>
                </div>
            </div>
            @include('Admin.agreement-summary.vehicles-table')
        </div>
        <div class="tab-pane fade" id="collaterals">
            Залоги...
        </div>
        <div class="tab-pane fade" id="payments">
            @php  $payments = $agreement->payments->sortBy('payment_date'); @endphp
            @php  $realPayments = $agreement->realPayments->sortBy('payment_date'); @endphp
            <div class="row">
                @include('Admin.agreement-summary.payment-tables')
                @include('Admin.agreement-summary.real-payment-tables')
            </div>
        </div>
        <div class="tab-pane fade" id="notes">
            <h4>Заметки по догору </h4>

            @include('Admin.agreement-summary.agreement-notes')
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function autoSelectPage() {
            let urlArr = document.location.pathname.split('/')

            if (urlArr.length === 6) {
                let tabName = '[href="#' + urlArr[5] + '"'
                $(tabName).tab('show')
            }
        }

        function confirmDelete() {

        }

        document.addEventListener("DOMContentLoaded", autoSelectPage);
    </script>

@endsection

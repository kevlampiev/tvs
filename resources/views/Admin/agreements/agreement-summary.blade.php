@extends('layouts.admin')

@section('title')
    Администратор|Карточка договора
@endsection

@section('content')
    <h3>Карточка договора № {{$agreement->agr_number}} от {{\Carbon\Carbon::parse($agreement->date_open)->format('d.m.Y')}}</h3>


    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active"
                    id="main-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#main"
                    type="button"
                    role="tab"
                    aria-controls="main"
                    aria-selected="true">
                Основная информация
            </button>
            <button class="nav-link"
                    id="documents-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#documents"
                    type="button"
                    role="tab"
                    aria-controls="documents"
                    aria-selected="true">
                Файлы/документы
            </button>
            <button class="nav-link"
                    id="vehicles-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#vehicles"
                    type="button"
                    role="tab"
                    aria-controls="vehicles"
                    aria-selected="true">
                Приобретенная техника
            </button>
            <button class="nav-link"
                    id="collaterals-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#collaterals"
                    type="button"
                    role="tab"
                    aria-controls="collaterals"
                    aria-selected="true">
                Залог
            </button>
            <button class="nav-link"
                    id="guarantees-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#guarantees"
                    type="button"
                    role="tab"
                    aria-controls="guarantees"
                    aria-selected="true">
                Поручительства
            </button>
            <button class="nav-link"
                    id="payments-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#payments"
                    type="button"
                    role="tab"
                    aria-controls="payments"
                    aria-selected="true">
                Платежи
            </button>
            <button class="nav-link"
                    id="tasks-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#tasks"
                    type="button"
                    role="tab"
                    aria-controls="tasks"
                    aria-selected="true">
                Задачи по договору
            </button>
            <button class="nav-link"
                    id="notes-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#notes"
                    type="button"
                    role="tab"
                    aria-controls="notes"
                    aria-selected="true">
                Заметки
            </button>

        </div>
    </nav>


    <div class="tab-content p-2" id="nav-tabContent">
        <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
            <h4>Основные данные</h4>
            @include('Admin.agreements.agreement-summary.agreement-main')
        </div>
        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
            <h4>Связанные файлы</h4>
            <div class="row m-1">
                <div class="col-md-12">
                    <a class="btn btn-outline-primary"
                       href="{{route('admin.addAgreementDocument',['agreement' => $agreement])}}" >
                        Добавить документ
                    </a>
                    @include('Admin.agreements.agreement-summary.agreement-files')
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="vehicles" role="tabpanel" aria-labelledby="vehicles-tab">
            <h4>Техника, приобретаемая по данному договору</h4>
            <div class="row">
                <div class="col-mb-12">
                <a class="btn btn-outline-info"
                   href="{{route('admin.agreementAddVehicle', ['agreement'=>$agreement])}}">Добавить единицу техники</a>
                </div>
            </div>
            @include('Admin.agreements.agreement-summary.vehicles-table')
        </div>

        <div class="tab-pane fade" id="collaterals" role="tabpanel" aria-labelledby="collaterals-tab">
            <h4>Техника в залоге по договору</h4>
            <div class="row m-1">
                <div class="col-md-12">
                    <a class="btn btn-outline-info"
                       href="{{route('admin.addDeposit', ['agreement'=>$agreement])}}">Добавить залоговую технику
                    </a>
                    @include('Admin.agreements.agreement-summary.agreement-deposits', ['deposits' => $agreement->deposites])
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="guarantees" role="tabpanel" aria-labelledby="guarantees-tab">
            <h4>Полученные поручительства по договору</h4>
            <div class="row m-1">
                <div class="col-md-12">
                    <a class="btn btn-outline-info"
                       href="{{route('admin.addGuaranteeLE', ['agreement'=>$agreement])}}">
                        Добавить поручительство компании
                    </a>
                    @include('Admin.agreements.agreement-summary.agreement-guarantees', ['guarantees' => $agreement->guarantees])
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
{{--            @php  $payments = $agreement->payments->sortBy('payment_date'); @endphp--}}
{{--            @php  $realPayments = $agreement->realPayments->sortBy('payment_date'); @endphp--}}
            <div class="row">
                @include('Admin.agreements.agreement-summary.payment-tables', ['payments' =>$agreement->payments->sortBy('payment_date')])
                @include('Admin.agreements.agreement-summary.real-payment-tables', ['realPayments' =>$agreement->realPayments->sortBy('payment_date')])
            </div>
        </div>

        <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
            <h4>Задачи по договору </h4>
            @include('Admin.agreements.agreement-summary.agreement-tasks')
        </div>

        <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
            <h4>Заметки по догору </h4>
            @include('Admin.agreements.agreement-summary.agreement-notes')
        </div>


    </div>


@endsection

@section('scripts')
    <script>
        function autoSelectPage() {
            let urlArr = document.location.pathname.split('/')
            if (urlArr.length === 6) {
                let tabName = '[data-bs-target="#' + urlArr[5] + '"'
                $(tabName).tab('show')
            }
        }
        document.addEventListener("DOMContentLoaded", autoSelectPage);
    </script>

@endsection

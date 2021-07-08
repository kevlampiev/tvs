@extends('layouts.admin')

@section('title')
    Администратор|Редактирование платежа
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-mb-8">
            <h3> Добавление периодически повторяющихся платежей </h3>
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="payment_date">Дата первого платежа</span>
                    <input type="date"
                           class="form-control {{$errors->has('date_start')?'is-invalid':''}}"
                           aria-describedby="payment_date"
                           name="date_start"
                           value="{{old('date_start')}}"
                    >
                </div>
                @if ($errors->has('date_start'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('date_start') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php $currencies = \Illuminate\Support\Facades\Config::get('constants.currencies') @endphp
                <div class="input-group mb-3">
                    <span class="input-group-text" id="amount">Сумма</span>
                    <input type="number" step="0.01" min="0" pattern="\d+(,\d{2})?"
                           class="form-control {{$errors->has('amount')?'is-invalid':''}}"
                           aria-describedby="amount"
                           name="amount" value="{{old('amount')}}">
                    <select name="currency"
                            class="form-control {{$errors->has('currency')?'is-invalid':''}}"
                            aria-describedby="currecies">
                        @foreach ($currencies as $currency)
                            <option
                                value="{{$currency}}" {{($currency == old('currency')) ? 'selected' : ''}}>
                                {{$currency}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('amount'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('amount') as $error)
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
                    <span class="input-group-text" id="repeat_count">Количество повторений</span>
                    <input type="number" step="1" min="1"
                           class="form-control {{$errors->has('repeat_count')?'is-invalid':''}}"
                           aria-describedby="repeat_count"
                           name="repeat_count" value="{{old('repeat_count')}}">
                </div>
                @if ($errors->has('repeat_count'))
                    <div class="alert alert-danger">
                        <ul class="p-0 m-0">
                            @foreach($errors->get('repeat_count') as $error)
                                <li class="m-0 p-0"> {{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">
                    Добавить
                </button>

                <a class="btn btn-secondary"
                   href="{{route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments'])}}">Отмена</a>

            </form>

        </div>
    </div>

@endsection

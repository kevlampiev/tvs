@extends('layouts.admin')

@section('title')
    Администратор|Редактирование платежа
@endsection

@section('content')

    <h3> Добавление периодически повторяющихся платежей </h3>
    <form method="POST">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="payment_date">Дата первого платежа</span>
            <input type="date_start"
                   class="form-control"
                   aria-describedby="payment_date"
                   name="date_start">
        </div>

        @php $currencies = ['RUR', 'USD', 'EUR', 'CNY', 'YPN'] @endphp
        <div class="input-group mb-3">
            <span class="input-group-text" id="amount">Сумма</span>
            <input type="number" step="0.01" min="0"
                   class="form-control"
                   aria-describedby="amount"
                   name="amount">
            <select name="currency"
                    class="form-control"
                    aria-describedby="currecies">
                @foreach ($currencies as $currency)
                    <option
                        value="{{$currency}}" {{($currency == $payment->currency) ? 'selected' : ''}}>
                        {{$currency}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="repeat_count">Количество повторений</span>
            <input type="number" step="1" min="1"
                   class="form-control"
                   aria-describedby="repeat_count"
                   name="repeat_count">
        </div>

        <button type="submit" class="btn btn-primary">
            Добавить
        </button>

        <a class="btn btn-secondary"
           href="{{route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments'])}}">Отмена</a>


    </form>


@endsection

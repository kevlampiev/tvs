@extends('Admin.layout')

@section('title')
    Администратор|Редактирование платежа
@endsection

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <h3> @if ($payment->id) Изменение платежа @else Добавить платеж @endif</h3>
    <form action="#" method="POST">
        @csrf
        <input type="hidden" value="{{$payment->agreement_id}}" name="agreement_id">
        <div class="input-group mb-3">
            <span class="input-group-text" id="payment_date">Дата платежа</span>
            <input type="date" class="form-control" aria-describedby="payment_date"
                    name="payment_date"  value="{{$payment->payment_date}}">
        </div>

        @php $currencies = ['RUR', 'USD', 'EUR', 'CNY', 'YPN'] @endphp
        <div class="input-group mb-3">
            <span class="input-group-text" id="amount">Сумма</span>
            <input type="number" class="form-control" aria-describedby="amount"
                   name="amount"  value="{{$payment->amount}}">
            <select name="currency" class="form-control" aria-describedby="currecies">
                @foreach ($currencies as $currency)
                    <option
                        value="{{$currency}}" {{($currency == $payment->currency) ? 'selected' : ''}}>
                        {{$currency}}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            @if ($payment->id)  Изменить @else Добавить @endif
        </button>

        <a class="btn btn-secondary" href="{{route('admin.agreementSummary', ['agreement' => $agreement, 'page' => 'payments'])}}">Отмена</a>


    </form>


@endsection

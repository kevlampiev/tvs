@extends('layouts.admin')

@section('title')
    Администратор|Закрытие платежей
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-mb-8">

            <h3 class="mb-5"> Отмена платежей (для замены графика) </h3>
            <form action="#" method="POST" >
                @csrf
                <input type="hidden" value="{{$agreement->id}}" name="agreement_id">
                <div class="form-group mb-3">
                    <label for="canceled_date">Дата отмены (дата принятия нового графика): </label>
                    <input type="date"
                           class="{{$errors->has('canceled_date')?'form-control is-invalid':'form-control'}}"
                           id="canceled_date"
                           name="canceled_date" >
                    @if ($errors->has('canceled_date'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('canceled_date') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

                <div class="form-group mb-3">
                    <label for="payment_list" class="form-label">Сумма:</label>
                    <select class="form-control" multiple
                            id="payment_list" name="payment_list[]" >
                        <option value="0">Open this select menu 111111111111111111111111111111111111111111111111111</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                </div>

                <button type="submit" class="btn btn-primary">
                    Отменить платежи
                </button>

                <a class="btn btn-secondary"
                   href="#">Отмена</a>


            </form>

        </div>
    </div>


@endsection

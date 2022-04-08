@extends('layouts.admin')

@section('title')
    Администратор|Редактирование поручительства юр.лица
@endsection

@section('content')
    <h3> @if ($guarantee->id) Изменение данных поручительства@else Добавить новое поручительство по договору @endif</h3>
    <form method="POST">
        @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="hidden" name="id">
                        <input type="hidden" name="agreement_id">
                    </div>
                    @if ($errors->has('agreement_id'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('agreement_id') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

{{--                    Компания - гарант --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="companies">Компания-гарант </span>
                        <select name="company_id"
                                class="form-control {{$errors->has('guarantor_id')?'is-invalid':''}}"
                                aria-describedby="companies">
                            @foreach ($companies as $company)
                                <option
                                    value="{{$company->id}}" {{($company->id == $guarantee->guarantor_id) ? 'selected' : ''}}>
                                    {{$company->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('guarantor_id'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('guarantor_id') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

{{--                    срок гарантии--}}

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="date_open">Срок действия</span>
                        <input type="date"
                               class="form-control {{$errors->has('date_open')?'is-invalid':''}}"
                               aria-describedby="date_open"
                               placeholder="Дата заключения" name="date_open"
                               value="{{$guarantee->date_open}}">
                        <input type="date"
                               class="form-control {{$errors->has('date_close')?'is-invalid':''}}"
                               aria-describedby="date_close"
                               placeholder="Планируемая дата окончания" name="date_close"
                               value="{{$guarantee->date_close}}">
                    </div>
                    @if ($errors->has('date_open'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('date_open') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($errors->has('date_close'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('date_close') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

{{--                    реальная дата погашения--}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="real_date_close">Реальная дата закрытия</span>
                        <input type="date"
                               class="form-control {{$errors->has('real_date_close')?'is-invalid':''}}"
                               aria-describedby="real_date_close"
                               placeholder="Реальная дата заершения" name="real_date_close"
                               value="{{$guarantee->real_date_close}}">
                    </div>
                    @if ($errors->has('real_date_close'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('real_date_close') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                </div>
                <div class="col-md-6 pl-3">
                    <div class="form-group">
                        <label for="description">Комментарий</label>
                        <textarea class="form-control {{$errors->has('description')?'is-invalid':''}}"
                                  id="description"
                                  rows="5" name="description">{{$guarantee->description}}</textarea>
                    </div>
                    @if ($errors->has('description'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('description') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                @if ($guarantee->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary"
               href="{{route('admin.agreementSummary', ['agreement'=>$guarantee->agreement_id, 'page' => 'guarantees'])}}">
                Отмена
            </a>

    </form>


@endsection



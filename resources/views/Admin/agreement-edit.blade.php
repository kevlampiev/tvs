@extends('Admin.layout')

@section('title')
    Администратор|Редактирование договора
@endsection

@section('content')
    <h3> @if ($agreement->id) Изменение данных договора@else Добавить новый договор @endif</h3>
    <form action="{{route($route, $agreement->id)}}" method="POST">
        @csrf
        <form>

            <div class="row">
                <div class="col-md6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Наименование договора</span>
                        <input type="text" class="form-control" aria-describedby="name"
                               placeholder="Введите название договора" name="name"
                               value="{{$agreement->name}}">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="companies">Компания группы </span>
                        <select name="company_id" class="form-control" aria-describedby="companies">
                            @foreach ($companies as $company)
                            <option
                                value="{{$company->id}}" {{($company->id == $agreement->company_id) ? 'selected' : ''}}>
                                {{$company->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="counterparties">Контрагент </span>
                        <select name="counterparty_id" class="form-control" aria-describedby="counterparties">
                            @foreach ($counterparties as $counterparty)
                                <option
                                    value="{{$counterparty->id}}" {{($counterparty->id == $agreement->counterparty_id) ? 'selected' : ''}}>
                                    {{$counterparty->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="agreementTypes">Контрагент </span>
                        <select name="agreement_type_id" class="form-control" aria-describedby="agreementTypes">
                            @foreach ($agreementTypes as $type)
                                <option
                                    value="{{$type->id}}" {{($type->id == $agreement->agrrement_type_id) ? 'selected' : ''}}>
                                    {{$type->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="agr_number">Номер договора</span>
                        <input type="text" class="form-control" aria-describedby="agr_number"
                               placeholder="Введите номер договора" name="agr_number"
                               value="{{$agreement->agr_number}}">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="date_open">Срок действия</span>
                        <input type="date" class="form-control" aria-describedby="date_open"
                               placeholder="Дата заключения" name="date_open"
                               value="{{$agreement->date_open}}">
                        <input type="date" class="form-control" aria-describedby="date_close"
                               placeholder="Планируемая дата окончания" name="date_close"
                               value="{{$agreement->date_close}}">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="real_date_close">Реальная дата закрытия</span>
                        <input type="date" class="form-control" aria-describedby="real_date_close"
                               placeholder="Реальная дата заершения" name="real_date_close"
                               value="{{$agreement->real_date_close}}">
                    </div>

                    @if ($agreement->file_name)
                        <a href="{{$agreement->file_name}}">Скан договора</a>
                    @else
                        <p> Скан договора отсутствует</p>
                    @endif

                </div>
                <div class="col-md6 pl-3">
                    <div class="form-group">
                        <label for="description">Комментарий</label>
                        <textarea class="form-control" id="description"
                                  rows="13" name="description">{{$agreement->description}}</textarea>
                    </div>


                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                @if ($agreement->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.agreements')}}">Отмена</a>

        </form>

    </form>


@endsection

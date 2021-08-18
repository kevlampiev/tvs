@extends('layouts.admin')

@section('title')
    Администратор|Изменение документа
@endsection

@section('content')
    <h3> @if ($document->id) Изменение данных@else Добавить новый документ@endif</h3>
    <form action="#" method="POST">
        @csrf

            <div class="row">
                <div class="col-md-12">
{{--                    Связанная техника--}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="vehicle">Связанная техника </span>
                        <select name="vehicle_id"
                                class="form-control {{$errors->has('vehicle_id')?'is-invalid':''}}"
                                aria-describedby="vehicle">
                            @foreach ($vehicles as $vehicle)
                                <option
                                    value="{{$vehicle->id}}" {{($vehicle->id == $document->vehicle_id) ? 'selected' : ''}}>
                                    {{$vehicle->name}} - {{$vehicle->vin}} - {{$vehicle->bort_number}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('vehicle_id'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('vehicle_id') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

{{--                связанный договор    --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="agreement">Договор </span>
                        <select name="agreement_id"
                                class="form-control {{$errors->has('agreement_id')?'is-invalid':''}}"
                                aria-describedby="agreement">
                            @foreach ($agreements as $agreement)
                                <option
                                    value="{{$agreement->id}}" {{($agreement->id == $document->agreement_id) ? 'selected' : ''}}>
                                    {{$agreement->name}} № {{$agreement->agr_number}} от {{$agreement->date_open}} {{$agreement->counterparty->name}}
                                </option>
                            @endforeach
                        </select>
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


                    {{--  связанная страховка  --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="insurance">Страховой полис </span>
                        <select name="insurance_id"
                                class="form-control {{$errors->has('insurance_id')?'is-invalid':''}}"
                                aria-describedby="insurance">
                            @foreach ($insurances as $insurance)
                                <option
                                    value="{{$insurance->id}}" {{($insurance->id == $document->insurance_id) ? 'selected' : ''}}>
                                    {{$insurance->insuranceCompany->name}} полис {{$insurance->insuranceType->name}} № {{$insurance->policy_number}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('insurance_id'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('insurance_id') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{--  название файла  --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="description">Наименование документа</span>
                        <input type="text"
                               class="form-control {{$errors->has('description')?'is-invalid':''}}"
                               aria-describedby="description"
                               name="description"
                               value="{{$document->description}}">
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


                    @if ($agreement->file_name)
                        <a href="{{$agreement->file_name}}">Скан договора</a>
                    @else
                        <p> Скан договора отсутствует</p>
                    @endif

                </div>


            </div>



            <button type="submit" class="btn btn-primary">
                @if ($agreement->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{session('previous_url', route('admin.agreements'))}}">Отмена</a>

    </form>


@endsection

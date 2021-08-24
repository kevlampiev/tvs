@extends('layouts.admin')

@section('title')
    Администратор|Редактирование страховки
@endsection

@section('content')
    <h3> @if ($insurance->id) Изменение данных страхования@else Добавить новый полис страхования @endif</h3>
    <form action="{{route($route, $insurance->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="policy_number">Номер полиса</span>
                        <input type="text"
                               class="form-control {{$errors->has('policy_number')?'is-invalid':''}}"
                               aria-describedby="policy_number"
                               name="policy_number"
                               value="{{$insurance->policy_number}}">
                    </div>
                    @if ($errors->has('policy_number'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('policy_number') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="vehicles">Единица техники </span>
                        <select name="vehicle_id"
                                class="form-control selectpicker {{$errors->has('vehicle_id')?'is-invalid':''}}"
                                aria-describedby="vehicles">
                            @foreach ($vehicles as $vehicle)
                                <option
                                    value="{{$vehicle->id}}" {{($vehicle->id == $insurance->vehicle_id) ? 'selected' : ''}}>
                                    {{$vehicle->name}} {{$vehicle->vin}} {{$vehicle->bort_number}}
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

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="insuranceCompanies">Страховщик </span>
                        <select name="insurance_company_id"
                                class="form-control {{$errors->has('insurance_company_id')?'is-invalid':''}}"
                                aria-describedby="insuranceCompanies">
                            @foreach ($insuranceCompanies as $insCompany)
                                <option
                                    value="{{$insCompany->id}}" {{($insCompany->id == $insurance->insurance_company_id) ? 'selected' : ''}}>
                                    {{$insCompany->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('insurance_company_id'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('insurance_company_id') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="insTypes">Тип полиса </span>
                        <select name="insurance_type_id"
                                class="form-control {{$errors->has('insurance_type_id')?'is-invalid':''}}"
                                aria-describedby="insTypes">
                            @foreach ($insTypes as $type)
                                <option
                                    value="{{$type->id}}" {{($type->id == $insurance->insurance_type_id) ? 'selected' : ''}}>
                                    {{$type->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('insurance_type_id'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('insurance_type_id') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="date_open">Срок действия</span>
                        <input type="date"
                               class="form-control {{$errors->has('date_open')?'is-invalid':''}}"
                               aria-describedby="date_open"
                               name="date_open"
                               value="{{$insurance->date_open}}">
                        <input type="date"
                               class="form-control {{$errors->has('date_close')?'is-invalid':''}}"
                               aria-describedby="date_close"
                               name="date_close"
                               value="{{$insurance->date_close}}">
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

                    @php $currencies = \Illuminate\Support\Facades\Config::get('constants.currencies') @endphp
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="insurance_amount">Страховая сумма</span>
                        <input type="number" step="0.01" min="0"
                               class="form-control {{$errors->has('insurance_amount')?'is-invalid':''}}"
                               aria-describedby="insurance_amount"
                               name="insurance_amount"
                               value="{{$insurance->insurance_amount}}">
                        <select name="amount_currency" id="amount_currency"
                                class="form-control {{$errors->has('amount_currency')?'is-invalid':''}}">
                            @foreach ($currencies as $currency)
                                <option value="{{$currency}}" {{($currency == $insurance->amount_currency) ? 'selected' : ''}}>
                                    {{$currency}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('insurance_amount'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('insurance_amount') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($errors->has('amount_currency'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('amount_currency') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="insurance_premium">Страховая премия</span>
                        <input type="number" step="0.01" min="0"
                               class="form-control {{$errors->has('insurance_premium')?'is-invalid':''}}"
                               aria-describedby="insurance_premium"
                               name="insurance_premium"
                               value="{{$insurance->insurance_premium}}">
                        <select name="premium_currency" id="premium_currency"
                                class="form-control {{$errors->has('premium_currency')?'is-invalid':''}}">
                            @foreach ($currencies as $currency)
                                <option value="{{$currency}}" {{($currency == $insurance->premium_currency) ? 'selected' : ''}}>
                                    {{$currency}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('insurance_premium'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('insurance_premium') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($errors->has('premium_currency'))
                        <div class="alert alert-danger">
                            <ul class="p-0 m-0">
                                @foreach($errors->get('premium_currency') as $error)
                                    <li class="m-0 p-0"> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                </div>





                <div class="col-md6 pl-3">
                    <div class="form-group">
                        <label for="description"><strong>Комментарий</strong></label>
                        <textarea class="form-control {{$errors->has('description')?'is-invalid':''}}"
                                  id="description"
                                  rows="10" name="description">{{$insurance->description}}</textarea>
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

                    <div class="input-group mb-3">
                        @if($insurance->policy_file)
                            <a href="{{route('user.filePreview', ['filename'=>'insurance/'.$insurance->policy_file])}}">
                                <img src="{{asset('/storage/img/pdf_download.png')}}">
                            </a>
                        @endif
                        <span class="ml-4 mr-4" id="file-status">
                            {{$insurance->policy_file?"Файл доступен для скачивания":"Файл полиса отсутствует"}}
                        </span>
                        <a href="#" class="btn btn-outline-secondary" id="policy_file"
                              onclick="uploadFile()">
                            Загрузить новый файл полиса
                        </a>
                        <input type="file" class="form-control-file" id="inputGroupFile01" name="policy_file"
                               accept="application/pdf" aria-describedby="policy_file" style="display: none;">

                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                @if ($insurance->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{session('previous_url', route('admin.insurances'))}}">Отмена</a>

    </form>


@endsection

@section('scripts')
<script>
   function uploadFile()
   {
       document.getElementById('inputGroupFile01').click()
       document.getElementById('file-status').textContent='Файл будет доступен после сохранения полиса'
   }
</script>
@endsection


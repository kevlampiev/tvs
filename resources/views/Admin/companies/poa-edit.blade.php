@extends('layouts.admin')

@section('title')
    Администратор|Редактирование доверенности
@endsection

@section('content')
    <h3> @if ($powerOfAttorney->id) Редактирование доверенности @else Добавить новую @endif</h3>
    <form method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Доверитель: {{$powerOfAttorney->company->name}}</label>
                <input type="hidden" name="company_id"
                       value="{{$powerOfAttorney->company_id}}">
                <input type="hidden" name="id"
                       value="{{$powerOfAttorney->id}}">
            </div>

{{--            Кому выдана--}}
            <div class="form-group">
                <label for="inputType">На кого выдана</label>
                <input type="text"
                       class="{{($errors->has('issued_for')?'form-control is-invalid':'form-control')}}"
                       id="issued_for" name="issued_for"
                       value="{{$powerOfAttorney->issued_for}}">
            </div>
            @if($errors->has('issued_for'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('issued_for') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

{{--            Номер доверенности--}}
            <div class="form-group">
                <label for="inputType">Номер доверенности</label>
                <input type="text"
                       class="{{($errors->has('poa_number')?'form-control is-invalid':'form-control')}}"
                       id="inputType" name="poa_number"
                       value="{{$powerOfAttorney->poa_number}}">
            </div>
            @if($errors->has('poa_number'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('poa_number') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{--            Краткое описание--}}
            <div class="form-group">
                <label for="inputType">Краткое описание</label>
                <input type="text"
                       class="{{($errors->has('subject')?'form-control is-invalid':'form-control')}}"
                       id="subject" name="subject"
                       value="{{$powerOfAttorney->subject}}">
            </div>
            @if($errors->has('subject'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('subject') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <!-- Текст доверенности -->
            <div class="form-group">
                <label for="description">Текст доверенности</label>
                <textarea class="form-control {{$errors->has('description')?'is-invalid':''}}"
                          id="description"
                          rows="6" name="description">{{$powerOfAttorney->description}}</textarea>
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

        <!-- Срок доверенности -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="start_date">Дата выдачи</span>
                <input type="date"
                       class="form-control {{$errors->has('date_open')?'is-invalid':''}}"
                       aria-describedby="date_open"
                       placeholder="Дата начала" name="date_open"
                       value="{{\Carbon\Carbon::parse($powerOfAttorney->date_open)->toDateString()}}">
                <input type="date"
                       class="form-control {{$errors->has('date_close')?'is-invalid':''}}"
                       aria-describedby="date_close"
                       placeholder="Дата завершения" name="date_close"
                       value="{{\Carbon\Carbon::parse($powerOfAttorney->date_close)->toDateString()}}">
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


            <button type="submit" class="btn btn-primary">
                @if ($powerOfAttorney->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.companies')}}">Отмена</a>

        </form>

    </form>


@endsection

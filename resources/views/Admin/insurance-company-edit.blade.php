@extends('layouts.admin')

@section('title')
    Администратор|Редактирование страховой
@endsection

@section('content')
    <h3> @if ($company->id) Редактирование @else Добавить новую @endif</h3>
    <form action="{{route($route, $company->id)}}" method="POST">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Наименование</label>
                <input type="text"
                       class="{{($errors->has('name')?'form-control is-invalid':'form-control')}}"
                       id="inputType" placeholder="Введите название" name="name"
                       value="{{$company->name}}">
            </div>
            @if($errors->has('name'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('name') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <button type="submit" class="btn btn-primary">
                @if ($company->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary" href="{{route('admin.insuranceCompanies')}}">Отмена</a>

        </form>

    </form>


@endsection

@extends('layouts.admin')

@section('title')
    Администратор|Загрузка выписки 1С
@endsection

@section('content')
    <div class="jumbotron">
        <h3>Загрузка выписки 1С</h3>
        <form method="POST">
            @csrf
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Загрузка банковской выписки</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                           aria-describedby="inputGroupFileAddon01" name="file1C">
                    <label class="custom-file-label" for="inputGroupFile01">Выберите файл</label>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-2">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Компания</th>
                    <th scope="col">Контрагент</th>
                    <th scope="col">сумма</th>
                    <th scope="col">Основание</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
{{--                @forelse($manufacturers as $index=>$manufacturer)--}}
{{--                    <tr>--}}
{{--                        <th scope="row">{{$index + 1}}</th>--}}
{{--                        <td>{{$manufacturer->name}}</td>--}}
{{--                        <td><a href="{{route('admin.editManufacturer',['manufacturer'=>$manufacturer])}}"> &#9998;Изменить </a>--}}
{{--                        </td>--}}

{{--                        @if ($manufacturer->vehicles_count===0)--}}
{{--                            <td><a href="{{route('admin.deleteManufacturer',['manufacturer'=>$manufacturer])}}"--}}
{{--                                   onclick="return confirm('Действительно удалить данные о произвоителе?')">--}}
{{--                                    &#10008;Удалить </a>--}}
{{--                            </td>--}}
{{--                        @else--}}
{{--                            <td><p class="text-muted">&#10008;Удалить </p></td>--}}
{{--                        @endif--}}
{{--                    </tr>--}}
{{--                @empty--}}
{{--                    <p>Нет записей</p>--}}
{{--                @endforelse--}}
                </tbody>
            </table>
        </div>
    </div>

    <div class="jumbotron">
        <form method="POST">
            @csrf
            <button class="" > Загрузить </button>
        </form>
    </div>

@endsection

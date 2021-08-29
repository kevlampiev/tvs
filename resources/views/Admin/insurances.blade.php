@extends('layouts.admin')

@section('title')
    Администратор| Страховки
@endsection

@section('content')

    <div class="row">
        <h2>Страховые полисы</h2>

    </div>

    @if ($filter!=='')
        <div class="alert alert-primary" role="alert">
            Установлен фильтр  " <strong> {{$filter}} </strong> "
        </div>
    @endif

    <div class="row">
{{--        <a class="btn btn-outline-info" href="#">Новый полис страхования</a>--}}
        <div class="col-md-6">
            <a class="btn btn-outline-info" href="{{route('admin.addInsurance')}}">Новый договор</a>
        </div>
        <div class="col-md-6">
            <form class="form-inline my-2 my-lg-0" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск страховых полисов" aria-label="Search" name="searchStr"
                       value="{{isset($filter)?$filter:''}}">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Поиск</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Единица техники</th>
                    <th scope="col">Страховщик</th>
                    <th scope="col">Тип полиса</th>
                    <th scope="col">Дата начала</th>
                    <th scope="col">Дата окончания</th>
                    <th scope="col">Страховая сумма</th>
                    <th scope="col">Страховая премия</th>
                    <th scope="col">Стоимость, %</th>
                    <th scope="col">Файл полиса</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($insurances as $index=>$insurance)
                    <tr>
                        <th scope="row">{{($index+1)}}</th>
                        <td>{{$insurance->vehicle->name}}</td>
                        <td>{{$insurance->insuranceCompany->name}}</td>
                        <td>{{$insurance->insuranceType->name}}</td>
                        <td>{{$insurance->date_open}}</td>
                        <td>{{$insurance->date_close}}</td>
                        <td>{{number_format($insurance->insurance_amount,2)}}</td>
                        <td>{{number_format($insurance->insurance_premium,2)}}</td>
                        <td> @if ($insurance->insurance_amount!=0)
                            {{number_format(100*$insurance->insurance_premium/$insurance->insurance_amount,1)}} %
                            @else
                                 --
                            @endif
                        </td>
                        <td>
                            @if($insurance->policy_file)
                                <a href="{{route('user.filePreview', ['filename'=>$insurance->policy_file])}}">
                                    <i class="bi bi-file-earmark-richtext"></i>
                                </a>
                            @else
                                --
                            @endif
                        </td>
                        <td><a href="{{route('admin.editInsurance', ['insurance'=>$insurance])}}"> &#9998;Изменить </a>
                        </td>
                        <td><a href="{{route('admin.deleteInsurance', ['insurance'=>$insurance])}}"
                               onclick="return confirm('Действительно удалить данные о полисе?')"> &#10008;Удалить </a>
                        </td>
                    </tr>
                @empty
                    <td colspan="12">Нет записей</td>
                @endforelse
                </tbody>
            </table>
            {!! $insurances->links() !!}
        </div>
    </div>
@endsection

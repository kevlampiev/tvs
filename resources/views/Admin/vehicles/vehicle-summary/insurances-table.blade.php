<div class="row">
    <div class="col-md-12">
    <a class="btn btn-outline-info" href="{{route('admin.addInsurance',['vehicle'=>$vehicle])}}">Новый полис</a>


<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Тип полиса</th>
        <th scope="col">Страховщик</th>
        <th scope="col">Номер полиса</th>
        <th scope="col">Дата открытия</th>
        <th scope="col">Дата завершения</th>
        <th scope="col">Файл полиса</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($vehicle->insurances as $index => $insurance)
        <tr {{($insurance->date_close<today())?'class=text-black-50':''}}>
            <th scope="row">{{$index+1}}</th>
            <td>{{$insurance->insuranceType->name}}</td>
            <td>{{$insurance->insuranceCompany->name}}</td>
            <td>{{$insurance->policy_number}}</td>
            <td>{{\Carbon\Carbon::parse($insurance->date_open)->format('d.m.Y')}}</td>
            <td>{{\Carbon\Carbon::parse($insurance->date_close)->format('d.m.Y')}}</td>

            <td>
                @if($insurance->policy_file)
                    <a href="{{route('user.filePreview', ['filename'=>$insurance->policy_file])}}">
                        <i class="bi bi-file-earmark-richtext">Просмотреть</i>
                    </a>
                @else
                    --
                @endif
            </td>

            <td>
                <a href="{{route('admin.editInsurance', ['insurance'=>$insurance])}}"> &#9998;Изменить </a>
            </td>
            <td>
                <a href="{{route('admin.deleteInsurance', ['insurance'=>$insurance])}}"
                   onclick="return confirm('Действительно удалить данные о полисе?')"> &#10008;Удалить </a>
            </td>
        </tr>
    @empty
        <tr>
            <th colspan="7">Нет записей</th>
        </tr>
    @endforelse
    </tbody>
</table>
    </div>
</div>
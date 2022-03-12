<div class="row">
    <div class="col-md-12">
    <a class="btn btn-outline-info"
       href="{{route('admin.attachAgreement', ['vehicle'=>$vehicle])}}">Привязать договор</a>


<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Тип договора</th>
        <th scope="col">Номер и дата</th>
        <th scope="col">Компания</th>
        <th scope="col">Контрагент</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($vehicle->agreements as $index => $agreement)
        <tr @if($agreement->real_date_close&&$agreement->real_date_close<=now()) class="text-black-50 agreement-close"@endif>
            <th scope="row">{{$loop->index+1}}</th>
            <td>{{$agreement->agreementType->name}}</td>
            <td>№ {{$agreement->agr_number}} от {{\Carbon\Carbon::parse($agreement->date_open)->format('d.m.Y')}} </td>
            <td>{{$agreement->company->name}}</td>
            <td>{{$agreement->counterparty->name}}</td>
            <td>
                <a href="{{route('admin.agreementSummary',['agreement'=>$agreement])}}">
                    &#9776;Карточка
                </a>
            </td>
            <td><a href="{{route('admin.agreementDetachVehicle', ['agreement'=>$agreement, 'vehicle'=>$vehicle])}}"
                   onclick="return confirm('Действительно удалить данные о связанном договоре?')">
                    &#10008;Удалить </a>
            </td>
        </tr>
    @empty
        <tr>
            <th colspan="7">1</th>
        </tr>
    @endforelse
    </tbody>
</table>
    </div>
</div>

@section("styles")
    <style>
        .agreement-close {
            text-decoration: line-through;
        }
    </style>
@endsection

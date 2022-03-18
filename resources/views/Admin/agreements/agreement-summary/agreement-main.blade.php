<table>
    <tr>
        <td class="text-right text-black-50">Наименование</td>
        <td class="text-left p-2">{{$agreement->name}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Номер и дата</td>
        <td class="text-left p-2">№ {{$agreement->agr_number}} от {{\Carbon\Carbon::parse($agreement->date_open)->format('d.m.Y')}}</td>
    </tr>

    <tr>
        <td class="text-right text-black-50">Тип договора</td>
        <td class="text-left p-2">{{$agreement->AgreementType->name}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Компания</td>
        <td class="text-left p-2">{{$agreement->Company->name}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Контрагент</td>
        <td class="text-left p-2">{{$agreement->Counterparty->name}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Описание</td>
        <td class="text-left p-2">{{$agreement->description}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Дата окончания</td>
        <td class="text-left p-2">{{\Carbon\Carbon::parse($agreement->date_close)->format('d.m.Y')}}</td>
    </tr>


    <tr>
        <td class="text-right text-black-50">Статус договора</td>
        <td class="text-left p-2">
            @if($agreement->real_date_close)
                Договора закрыт {{\Carbon\Carbon::parse($agreement->real_date_close)->format('d.m.Y')}}
            @else
                Действующий договор
            @endif
        </td>
    </tr>

    <tr>
        <td class="text-right text-black-50"></td>
        <td>
            @if(Auth::user()->role!='user')
                <a href="{{route('admin.editAgreement',['agreement'=>$agreement])}}"
                   class="btn btn-outline-secondary" role="button" aria-pressed="true">Отредактировать</a>
            @endif
        </td>
    </tr>


</table>



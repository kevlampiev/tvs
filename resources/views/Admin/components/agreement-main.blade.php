<table>
    <tr>
        <td class="text-right text-black-50">Наименование</td>
        <td class="text-left p-2">{{$agreement->name}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Номер и дата</td>
        <td class="text-left p-2">№ {{$agreement->agr_number}} от {{$agreement->date_open}}</td>
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
        <td class="text-left p-2">{{$agreement->date_close}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Реальная дата окончания</td>
        <td class="text-left p-2">{{$agreement->real_date_close}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Скан договора</td>
        <td class="text-left p-2">{{$agreement->file_name}}</td>
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



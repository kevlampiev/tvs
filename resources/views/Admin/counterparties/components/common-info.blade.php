<table>
    <tr>
        <td class="text-right text-black-50">Наименование</td>
        <td class="text-left p-2">{{$counterparty->name}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">ИНН</td>
        <td class="text-left p-2"> {{$counterparty->inn}}</td>
    </tr>

    <tr>
        <td class="text-right text-black-50">Почтовый адрес</td>
        <td class="text-left p-2">{{$counterparty->post_adress}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Руководитель</td>
        <td class="text-left p-2">{{$counterparty->header}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Контактный телефон</td>
        <td class="text-left p-2">{{$counterparty->phone}}</td>
    </tr>

    <tr>
        <td class="text-right text-black-50"></td>
        <td>
            @if(Auth::user()->role=='admin')
                <a href="{{route('admin.editCounterparty',['counterparty'=>$counterparty])}}"
                   class="btn btn-outline-secondary" role="button" aria-pressed="true">Отредактировать</a>
            @endif
        </td>
    </tr>


</table>

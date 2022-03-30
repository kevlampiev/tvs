<table>
    <tr>
        <td class="text-right text-black-50">Наименование</td>
        <td class="text-left p-2">{{$company->name}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Код</td>
        <td class="text-left p-2"> {{$company->code}}</td>
    </tr>


    <tr>
        <td class="text-right text-black-50"></td>
        <td>
            @if(Auth::user()->role=='admin')
                <a href="{{route('admin.editCompany',['company'=>$company])}}"
                   class="btn btn-outline-secondary" role="button" aria-pressed="true">Отредактировать</a>
            @endif
        </td>
    </tr>


</table>

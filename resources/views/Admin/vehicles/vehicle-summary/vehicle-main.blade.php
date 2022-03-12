<table>
    <tr>
        <td class="text-right text-black-50">Вид оборудования</td>
        <td class="text-left p-2">{{$vehicle->vehicleType->name}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Наименование производителя</td>
        <td class="text-left p-2">{{$vehicle->manufacturer->name}}</td>
    </tr>

    <tr>
        <td class="text-right text-black-50">Наименование единицы</td>
        <td class="text-left p-2">{{$vehicle->name}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Заводской номер/VIN</td>
        <td class="text-left p-2">{{$vehicle->vin}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Бортовой номер</td>
        <td class="text-left p-2">{{$vehicle->bort_number}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Год выпуска</td>
        <td class="text-left p-2">{{$vehicle->prod_year}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Торговая марка</td>
        <td class="text-left p-2">{{$vehicle->trademark}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Модель</td>
        <td class="text-left p-2">{{$vehicle->model}}</td>
    </tr>
    <tr>
        <td class="text-right text-black-50">Цена приобретения</td>
        <td class="text-left p-2">{{number_format($vehicle->price,2)}} {{$vehicle->currency}}</td>
    </tr>

    <tr>
        <td class="text-right text-black-50">Дата приобретения</td>
        <td class="text-left p-2">{{\Carbon\Carbon::parse($vehicle->purchase_date)->format('d.m.Y')}}</td>
    </tr>

    <tr>
        <td class="text-right text-black-50"></td>
        <td>
            @if(Auth::user()->role!='user')
                <a href="{{route('admin.editVehicle',['vehicle'=>$vehicle])}}"
                   class="btn btn-outline-secondary" role="button" aria-pressed="true">Отредактировать</a>
            @endif
        </td>
    </tr>


</table>



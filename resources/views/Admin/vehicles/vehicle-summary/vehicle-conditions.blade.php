<div class="row m-1">
    <div class="col-md-12">
        <a class="btn btn-outline-info"
{{--           href="{{route('admin.addVehicleToDeposit',['vehicle'=>$vehicle])}}" >--}}
           href="{{route('admin.addVehicleCondition',['vehicle'=>$vehicle])}}" >
            Добавить новое состояние
        </a>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дата</th>
                <th scope="col">Состояние техники</th>
                <th scope="col">Комментарий</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @php $names = \Illuminate\Support\Facades\Config::get('constants.vehicleConditions') @endphp
            @forelse($vehicle->conditions->sortByDesc('date_open') as $condition)
                <tr >
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{\Carbon\Carbon::parse($condition->date_open)->format('d.m.Y')}} </td>
                <td> {{$names[$condition->condition]}}</td>
                <td>{{$condition->description}}</td>
                <td><a href="{{route('admin.editVehicleCondition', ['vehicleCondition'=>$condition])}}">
                        &#9998;Изменить </a>
                </td>
                <td><a href="{{route('admin.deleteVehicleCondition', ['vehicleCondition'=>$condition])}}"
                       onclick="return confirm('Действительно удалить данные о состоянии?')">
                        &#10008;Удалить </a>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-secondary font-italic text-center"> Нет данных для отображения</td>
                </tr>

            @endforelse

            </tbody>
        </table>
    </div>
</div>

<div class="row m-1">
    <div class="col-md-12">
        <a class="btn btn-outline-info"
           href="{{route('admin.addVehicleIncident',['vehicle'=>$vehicle])}}" >
            Добавить запись об инциденте
        </a>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дата инцидента</th>
                <th scope="col">Описание</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($vehicle->incidents as $incident)
                <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{\Carbon\Carbon::parse($incident->date_open)->format('d.m.Y')}}</td>
                <td>{{$incident->description}}</td>

                <td><a href="{{route('admin.editVehicleIncident', ['vehicleIncident'=>$incident])}}">
                        &#9998;Изменить </a>
                </td>
                <td><a href="{{route('admin.deleteVehicleIncident', ['vehicleIncident'=>$incident])}}"
                       onclick="return confirm('Действительно удалить данные об инциденте?')">
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

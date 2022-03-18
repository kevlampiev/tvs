<div class="row m-1">
    <div class="col-md-12">
    <a class="btn btn-outline-info"
       href="{{route('admin.addVehiclePhoto',['vehicle'=>$vehicle])}}" >
        Добавить фотографию
    </a>
    </div>
</div>

<div class="file-info-container">

@forelse($vehicle->photos as $vehiclePhoto)
    <div class="card m-2" style="width: 18rem;">
        <a href="{{route('admin.showVehiclePhoto', ['vehiclePhoto' => $vehiclePhoto])}}">
            <img src="{{asset(config('paths.vehicles.get','storage/img/vehicles/').$vehiclePhoto->img_file)}}"
                 class="card-img-top vehicle-show-img m-1" alt="...">
        </a>
        <div class="card-body">
            <h5 class="card-title">{{$vehiclePhoto->created_at}}</h5>
            <p class="card-text">{{$vehiclePhoto->comment}}</p>
            <a href="{{route('admin.editVehiclePhoto', ['vehiclePhoto' => $vehiclePhoto])}}" class="btn btn-outline-primary">Изменить</a>
            <a href="{{route('admin.deleteVehiclePhoto', ['vehiclePhoto' => $vehiclePhoto])}}"
               onclick="return confirm('Действительно удалить фотографию?')"
               class="btn btn-outline-secondary">Удалить</a>
        </div>
    </div>
@empty
    <p>Для данной единицы техники нет фотографий</p>
@endforelse

</div>


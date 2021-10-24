<div class="row m-1">
    <a class="btn btn-outline-primary"
       href="{{route('admin.addVehicleDocument',['vehicle'=>$vehicle])}}" >
        Добавить фотографию
    </a>
</div>

<div class="file-info-container">

@forelse($vehicle->photos as $photo)
    <div class="card m-2" style="width: 18rem;">
        <img src="{{asset(config('paths.vehicles.get','storage/img/vehicles/').$photo->img_file)}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$photo->craeted_at}}</h5>
            <p class="card-text">{{$photo->comment}}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
@empty
    <p>Для данной единицы техники нет фотографий</p>
@endforelse

</div>

@section('styles')
<style>
    .file-info-container {

    }
</style>
@endsection

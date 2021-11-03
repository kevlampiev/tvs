@extends('layouts.admin')

@section('title')
    Администратор|Изменение фотографии
@endsection

@section('content')
    <h3> @if ($vehiclePhoto->id) Изменение фотографии @else Добавить фотографию техники @endif</h3>
    <form action="{{$route}}" method="POST" enctype="multipart/form-data">
        @csrf
        <form>
            <div class="form-group">
                <label for="inputType">Единица техники</label>
                <input type="hidden"
                       id="vehicle_id" name="vehicle_id" value="{{$vehiclePhoto->vehicle_id}}">
                <input type="text"
                       id="input-vehicle" name="vehicle" value="{{$vehiclePhoto->vehicle->name}}" disabled>
            </div>
            @if ($errors->has('vehicle_id'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('vehicle_id') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($errors->has('vehicle'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('vehicle') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <img class="vehicle-photo-img"
                 @if($vehiclePhoto->img_file)
                    src="{{asset(config('paths.vehicles.get','storage/img/vehicles/').$vehiclePhoto->img_file)}}"
                 @else
                 src="https://st.depositphotos.com/1987177/3470/v/950/depositphotos_34700099-stock-illustration-no-photo-available-or-missing.jpg"
                 @endif
                 onclick="document.getElementById('inputGroupFile01').click()">

            <div class="input-group mb-3">
                <input type="file" class="form-control-file" id="inputGroupFile01" name="img_file"
                       accept="image/*" style="display:none">
            </div>
            @if ($errors->has('img_file'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('img_file') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="description">Комментарий</label>
                <textarea class="form-control {{$errors->has('comment')?'is-invalid':''}}"
                          id="comment"
                          rows="5" name="comment">{{$vehiclePhoto->comment}}</textarea>
            </div>
            @if ($errors->has('comment'))
                <div class="alert alert-danger">
                    <ul class="p-0 m-0">
                        @foreach($errors->get('comment') as $error)
                            <li class="m-0 p-0"> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <button type="submit" class="btn btn-primary">
                @if ($vehiclePhoto->id)  Изменить @else Добавить @endif
            </button>
            <a class="btn btn-secondary"
               href="{{route('admin.vehicleSummary',['vehicle'=>$vehiclePhoto->vehicle_id, 'page' => 'photos'])}}">
                Отмена
            </a>

        </form>

    </form>


@endsection

@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('.vehicle-photo-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#inputGroupFile01").change(function() {
            readURL(this);
        });



    </script>
@endsection

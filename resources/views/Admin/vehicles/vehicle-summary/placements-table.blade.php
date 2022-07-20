<div class="row">
    <div class="col-md-12">
    <a class="btn btn-outline-info"
       href="{{route('admin.addPlacement', ['vehicle'=>$vehicle])}}"
    >
        Добавить место дислокации техники
    </a>


<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Дата</th>
        <th scope="col">Место хранения</th>
        <th scope="col">Комментарий</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>

    @forelse($vehicle->placements as $index => $placement)
        <tr>
            <th scope="row">{{$loop->index+1}}</th>
            <td>{{\Carbon\Carbon::parse($placement->date_open)->toDateString()}}</td>
            <td>{{$placement->location->name}}</td>
            <td>{{$placement->description}}</td>
            <td><a href="{{route('admin.editPlacement',['placement'=>$placement])}}"> &#9998;Изменить </a></td>
            <td><a href="{{route('admin.deletePlacement',['placement'=>$placement])}}"
                   onclick="return confirm('Действительно удалить данные о местонахождении?')"> &#10008;Удалить </a></td>
        </tr>
    @empty
        <tr>
            <th colspan="6">Техника в неопределенном месте</th>
        </tr>
    @endforelse
    </tbody>
</table>
    </div>
</div>

@section("styles")
    <style>
        .agreement-close {
            text-decoration: line-through;
        }
    </style>
@endsection

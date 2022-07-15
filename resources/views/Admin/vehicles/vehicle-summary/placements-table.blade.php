<div class="row">
    <div class="col-md-12">
    <a class="btn btn-outline-info"
{{--       href="{{route('admin.attachAgreement', ['vehicle'=>$vehicle])}}"--}}
        href="#"
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
            <td>{{\Carbon\Carbon::parse($location->date_open)->toDateString()}}</td>
            <td>{{$placement->location->name}}</td>
            <td>{{$placement->description}}</td>
            <td></td>
            <td></td>
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

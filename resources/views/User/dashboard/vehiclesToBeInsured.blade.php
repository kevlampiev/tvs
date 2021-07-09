<div class="vehiclesToBeInsured">
    @forelse($runningOutOfIns as $index=>$el)
    {{$index + 1}}. {{$el->name}} <br>
    @empty
        хоть тут все хорошо
    @endforelse

</div>

<div class="row">
    <div class="col-md-9">
        Всего необходимо оформить страховки на {{count($runningOutOfIns)}} ед.техники
    </div>
    <div class="col-md-3 text-right">
        <a href="{{route('user.nearestPayments')}}">Подробнее...</a>
    </div>
</div>

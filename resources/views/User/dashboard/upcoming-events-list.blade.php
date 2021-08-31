{{--<div class="vehiclesToBeInsured">--}}
{{--    @forelse($runningOutOfIns as $index=>$el)--}}
{{--    {{$index + 1}}. {{$el->name}} <br>--}}
{{--    @empty--}}
{{--        хоть тут все хорошо--}}
{{--    @endforelse--}}

{{--</div>--}}

{{--<div class="row">--}}
{{--    <div class="col-md-9">--}}
{{--        Всего необходимо оформить страховки на <strong>{{count($runningOutOfIns)}} ед.техники </strong>--}}
{{--    </div>--}}
{{--    <div class="col-md-3 text-right">--}}
{{--        <a href="{{route('user.insurancesToRenewal')}}">Подробнее...</a>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="row">
    <div class="col-md-12">
        <ol class="list-group list-group-numbered m-4">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><strong>Страховки к переоформлению</strong></div>
                    <p>Страховки, действие которых заканчивается, а также незаcтрахованная техника</p>
                    <a href="{{route('user.insurancesToRenewal')}}">Подробнее...</a>
                </div>
                @if(count($runningOutOfIns)>0)
                    <span class="badge bg-primary rounded-pill">{{count($runningOutOfIns)}}</span>
                @endif
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><strong>Техника, выходящая из лизинга</strong></div>
                    <p>Заканчивающиеся финансовые договора по которым нет просрочек <i>(модуль пока не реализован)</i></p>
                    <a href="#">Подробнее...</a>
                </div>
                @if(true)
                    <span class="badge bg-primary rounded-pill">14</span>
                @endif
            </li>

        </ol>
    </div>
</div>
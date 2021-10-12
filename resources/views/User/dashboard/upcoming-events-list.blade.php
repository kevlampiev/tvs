
<div class="row">
    <div class="col-md-12">
        <ol class="list-group list-group-numbered m-4">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><strong>Страховки</strong></div>
                        @if(count($runningOutOfIns)>0)
                            <p>
                                Страховки, действие которых заканчивается
                                <span class="badge bg-warning rounded-pill">{{count($runningOutOfIns)}}</span>
                            </p>
                        @endif
                        @if($uninsuredVehiclesCount>0)
                            <p>
                                Ни разу не застрахованная техника
                                <span class="badge bg-danger rounded-pill">{{$uninsuredVehiclesCount}}</span>
                            </p>
                        @endif
                        @if($uninsuredVehiclesCount==0&&count($runningOutOfIns))
                            <p>
                                <i>Все идеально ...</i>
                            </p>
                        @endif


                    <a href="{{route('user.insurancesToRenewal')}}">Подробнее...</a>
                </div>

            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><strong>Техника</strong></div>
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

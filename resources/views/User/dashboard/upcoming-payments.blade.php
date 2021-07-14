<div id="chart" ></div>

<div class="row mt-3">
    <div class="col-md-9">
        Просрочено по группе <strong>{{number_format($summary->overdue,1)}} млн,</strong>,
        ближайшие платежи по сроку <strong>{{number_format($summary->upcoming,1)}} млн, </strong>
        Всего: <strong>{{number_format($summary->upcoming + $summary->overdue,1)}} млн</strong>
    </div>
    <div class="col-md-3 text-right">
        <a href="{{route('user.nearestPayments')}}">Подробнее...</a>
    </div>

</div>

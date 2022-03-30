<div class="row">
    <div class="col-md-12">
        <a class="btn btn-outline-info"
           href="{{route('admin.addPOA', ['company' => $company])}}">
            Добавить Доверенность
        </a>
    </div>
</div>

<div class="row m-1">
    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Номер доверенности</th>
                <th scope="col">Кому выдана доверенность</th>
                <th scope="col">Краткое описание</th>
                <th scope="col">Дата начала</th>
                <th scope="col">Дата окончания</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($company->poas as $poa)
                <tr
                    @if ($poa->date_close<now())
                          class="text-secondary text-decoration-line-through"
                    @endif
                >
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>{{$poa->poa_number}}</td>
                    <td>{{$poa->issued_for}}</td>
                    <td>{{$poa->subject}}</td>
                    <td>{{$poa->date_open}}</td>
                    <td>{{$poa->date_close}}</td>
                    <td>
                        <a href="{{route('admin.editPOA', ['powerOfAttorney' => $poa])}}">
                            &#9776;Изменить
                        </a>
                    </td>
                    <td>
                        <a href="{{route('admin.deletePOA', ['powerOfAttorney' => $poa])}}"
                        onclick="return confirm('Действительно удалить доверенность?')">
                            &#10008;Удалить
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <th colspan="4" class="text-secondary font-italic">Нет данных для отображения</th>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

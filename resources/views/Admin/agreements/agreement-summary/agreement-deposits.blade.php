
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Единица техники</th>
                <th scope="col">Дата начала залога</th>
                <th scope="col">Плановая дата окончания залога</th>
                <th scope="col">Договор/комментарий</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($deposits as $deposit)
            <tr @if($deposit->real_date_close) class="text-secondary text-decoration-line-through" @endif>
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{$deposit->vehicle->name}} VIN: {{$deposit->vehicle->vin}}</td>
                <td>{{\Carbon\Carbon::parse($deposit->date_open)->format('d.m.Y')}}</td>
                <td>{{\Carbon\Carbon::parse($deposit->date_close)->format('d.m.Y')}}</td>
                <td>{{$deposit->description}}</td>
                <td><a href="{{route('admin.vehicleSummary',['vehicle'=>$deposit->vehicle])}}"> &#9776;Карточка </a></td>
                <td><a href="{{route('admin.editDeposit', ['deposit'=>$deposit])}}">
                        &#9998;Изменить </a>
                </td>
                <td><a href="{{route('admin.deleteDeposit', ['deposit'=>$deposit])}}"
                       onclick="return confirm('Действительно удалить данные о залоге?')">
                        &#10008;Удалить </a>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-secondary font-italic text-center"> Нет данных для отображения</td>
                </tr>

            @endforelse

            </tbody>
        </table>

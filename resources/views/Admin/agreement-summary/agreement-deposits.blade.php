
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Единица техники</th>
                <th scope="col">Дата начала залога</th>
                <th scope="col">Плановая дата окончания залога</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($deposits as $deposit)
            <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{$deposit->vehicle->name}} VIN: {{$deposit->vehicle->vin}}</td>
                <td>{{\Carbon\Carbon::parse($deposit->date_open)->format('d.m.Y')}}</td>
                <td>{{\Carbon\Carbon::parse($deposit->date_close)->format('d.m.Y')}}</td>
                <td>@mdo</td>
            </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-secondary font-italic text-center"> Нет данных для отображения</td>
                </tr>

            @endforelse

            </tbody>
        </table>

<div class="row m-1">
    <div class="col-md-12">
        <a class="btn btn-outline-info"
           href="{{route('admin.addVehicleToDeposit',['vehicle'=>$vehicle])}}" >
            Добавить договор по которому техника служит залогом
        </a>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Договор</th>
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
            <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{$deposit->agreement->name}} № {{$deposit->agreement->agr_number}}
                    от {{\Carbon\Carbon::parse($deposit->agreement->date_open)->format('d.m.Y')}}</td>
                <td>{{\Carbon\Carbon::parse($deposit->date_open)->format('d.m.Y')}}</td>
                <td>{{\Carbon\Carbon::parse($deposit->date_close)->format('d.m.Y')}}</td>
                <td>{{$deposit->description}}</td>
                <td>
                    <a href="{{route('admin.agreementSummary',['agreement'=>$deposit->agreement])}}">
                        &#9776;Карточка
                    </a>
                </td>
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
    </div>
</div>

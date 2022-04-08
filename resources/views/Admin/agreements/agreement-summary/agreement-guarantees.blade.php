<div class="row m-1">
    <div class="col-md-12">

        <div class="notes-container">

        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Гарант</th>
                <th scope="col">Дата предоставления</th>
                <th scope="col">Дата дата окончания</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($agreement->guaranteesLegalEntity as $index=>$guarantee)
                <tr class="{{$guarantee->real_date_close?'text-black-50':''}}">
                    <th scope="row">{{$loop->index + 1}}</th>
                    <td>{{$guarantee->guarantor->name}}</td>
                    <td>{{\Carbon\Carbon::parse($guarantee->date_open)->format("d.m.Y")}}</td>
                    <td>{{\Carbon\Carbon::parse($guarantee->date_close)->format("d.m.Y")}}</td>
                    <td> @if($guarantee->real_date_close)
                            Прекращено {{\Carbon\Carbon::parse($guarantee->real_date_close)->format("d.m.Y")}}
                         @endif
                    </td>
                    <td>
                        <a href="{{route('admin.editGuaranteeLE', ['guarantee'=>$guarantee])}}">
                            &#9998;Изменить </a>
                    </td>
                    <td><a href="{{route('admin.deleteGuaranteeLE', ['guarantee'=>$guarantee])}}"
                           onclick="return confirm('Действительно удалить данные о гарантии?')">
                            &#10008;Удалить </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6"> Нет данных  для отображения </td>
                </tr>
            @endforelse

            </tbody>
        </table>

    </div>
</div>

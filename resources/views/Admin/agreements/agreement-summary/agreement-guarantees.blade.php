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
            </tr>
            </thead>
            <tbody>
            @forelse($agreement->guaranteesLegalEntity as $index=>$guarantee)
                <tr>
                    <th scope="row">{{$loop + 1}}</th>
                    <td>{{$guarantee->guarantor->name}}</td>
                    <td>{{\Carbon\Carbon::parse($guarantee->date_open)->format("d.m.Y")}}</td>
                    <td>{{\Carbon\Carbon::parse($guarantee->date_close)->format("d.m.Y")}}</td>
                    <td>
                        <a href="{{route('admin.editGuaranteeLE', ['guarantee'=>$guarantee])}}">
                            &#9998;Изменить </a>
                    </td>
                    <td><a href="{{route('admin.deleteGuaranteeLE', ['$guarantee'=>$guarantee])}}"
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

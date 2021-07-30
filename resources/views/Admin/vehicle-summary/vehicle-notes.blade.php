<div class="row m-1">
    <button class="btn btn-outline-primary">Добавить заметку</button>
</div>

<div class="notes-container">

    @for($i=0;$i<7;$i++)
        <div class="card mb-3">
            <div class="card-header">
                <strong> Имя пользователя </strong>     21.08.2021 15:0{{$i}}
            </div>
            <div class="card-body">
                <p>Что есть добро, а что зло - не поймешь </p>
            </div>
            @if($i==1)
                <div class="card-footer text-muted">
                    <a href="#" class="mr-5"> &#9998;Изменить </a>
                    <a href="#" onclick="return confirm('Действительно удалить заметку?')"> &#10008;Удалить </a>
                </div>
            @endif
        </div>
    @endfor

</div>

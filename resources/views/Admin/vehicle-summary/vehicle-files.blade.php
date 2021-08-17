<div class="row m-1">
    <a class="btn btn-outline-primary" href="#">Добавить документ</a>
</div>

<div class="file-info-container">

    @for($i=1;$i<4;$i++)
    <div class="card m-2" style="width: 18rem;">
        <div class="card-body">
            <a href="#" >
                <i class="bi bi-file-earmark-bar-graph"></i>
                <p class="card-text clr-gray mb-2 p-2">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </a>
            <a href="#" class="btn btn-outline-primary" onclick="alert('xx')">&#9998;Изменить</a>
            <a href="#" class="btn btn-outline-secondary">&#10008;Удалить</a>
        </div>
    </div>

    @endfor
</div>

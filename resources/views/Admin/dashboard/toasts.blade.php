
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11" data-bs-autohide="false">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Сообщение сервера</strong>
            <small>11 мин назад</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Закрыть"></button>
        </div>
        <div class="toast-body">
            <a class="text-secondary" id="toast-data" href="#">Посмотреть</a>
        </div>

    </div>
</div>

<script>
    Echo.private('user.{{auth()->user()->id}}')
        .listenToAll((e, data) => {showServerMessage(data)});
    // .listenToAll( (e, data) => console.log(data));

    Echo.channel('common')
        .listen('RealTimeMessage', (e) => console.log('RealTimeMessage: ' + e.message));


    function showServerMessage(data)
    {
        console.log(data)
        let toastWindow = document.getElementById('liveToast')
        let toastData = document.getElementById('toast-data')
        toastData.innerHTML = data.message
        toastData.href = data.routeToRedirect
        let toast = new bootstrap.Toast(toastWindow)
        // console.log('Im inside')
        toast.show()

    }


</script>

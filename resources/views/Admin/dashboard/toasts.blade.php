
{{--<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11" data-bs-autohide="false">--}}
{{--    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">--}}
{{--        <div class="toast-header">--}}
{{--            <strong class="me-auto">Сообщение сервера</strong>--}}
{{--            <small>11 мин назад</small>--}}
{{--            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Закрыть"></button>--}}
{{--        </div>--}}
{{--        <div class="toast-body">--}}
{{--            <a class="text-secondary" id="toast-data" href="#">Посмотреть</a>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}

<script>
    Echo.private('user.{{auth()->user()->id}}')
        .listenToAll((e, data) => {showServerMessage(data)});
    // .listenToAll( (e, data) => console.log(data));

    Echo.channel('common')
        .listen('RealTimeMessage', (e) => console.log('RealTimeMessage: ' + e.message));


    function showServerMessage(data)
    {
        console.log(data)
        new Noty({
                type: 'info',
                layout: 'bottomRight',
                modal: true,
                theme: 'mint',
                timeout: 300000,
                text: data.message,
                callbacks: {
                    onTemplate: function() {
                           this.barDom.innerHTML =
                               '<a class="text-white text-decoration-none" href="'+
                                data.routeToRedirect+
                                '">'+data.message+"</a>";
                        }
                    }
            }).show();

    }


</script>

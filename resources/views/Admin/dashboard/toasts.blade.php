

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
                               '<div class="p-2"><a class="text-white text-decoration-none" href="'+
                                data.routeToRedirect+
                                '">'+data.message+"</a> </div>";
                        }
                    }
            }).show();

    }


</script>

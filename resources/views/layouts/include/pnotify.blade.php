@if(session('message'))
    <script>
        $(document).ready(function () {
            "use-strict"
    
            @if(desktopNotificationOn())
            PNotify.desktop.permission();
            (new PNotify({
                    title: '{{session('title')}}',
                    type: '{{session('type')}}',
                    text: '{{session('message')}}',
                    desktop: {
                        desktop: true, icon: '{{getSystemSetting('favicon_icon')}}'
                    }
                }
            )).get().click(function (e) {
                if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
                alert('Hey! You clicked the desktop notification!');
            });

            @else
            new PNotify({
                title: '{{session('title')}}', text: '{{session('message')}}', type: '{{session('type')}}'
            });
            @endif
        });
    </script>
@endif

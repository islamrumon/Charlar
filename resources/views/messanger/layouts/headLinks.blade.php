<title>{{ config('chatify.name') }}</title>

{{-- Meta tags --}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="id" content="{{ $id }}">
<meta name="type" content="{{ $type }}">
<meta charset="UTF-8">
<meta name="messenger-color" content="{{ $messengerColor }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url" content="{{ url('') . '/' . config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">

{{-- scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.js"></script>
<script src="{{ asset('js/emojionearea.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>


<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>



<script>
    "use strict"

    $(document).ready(function() {
    $("#textArea").emojioneArea();
  });

    // const zone = document.getElementById("textArea");
    // const test = document.getElementById("test");
    // alert(test);
    // var emojiKeyboard = new EmojiKeyboard;
    // /* you can edit a few attributes:
    //     - callback: function called when a user clicks on an emoji, with the emoji and a boolean telling if the window got closed
    //     - auto_reconstruction: boolean if we should recreate the keyboard when we cannot find it
    //     - default_placeholder: placeholder text in the search bar
    //     - resizable: boolean if the window can be resized (left side)
    // */
    // emojiKeyboard.callback = (emoji, closed) => {
    //     console.info(emoji, closed)
    //     zone.innerText += emoji.emoji;
    // };
    // emojiKeyboard.resizable = true;
    // emojiKeyboard.default_placeholder = "You are the best";
    // // emojiKeyboard.instantiate(true)
    // emojiKeyboard.toggle_window();
</script>

{{-- styles --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css' />
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/' . $dark_mode . '.mode.css') }}" rel="stylesheet" />
<link href="{{ asset('css/emojionearea.css') }}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


{{-- Messenger Color Style --}}
@include('messanger.layouts.messengerColor')

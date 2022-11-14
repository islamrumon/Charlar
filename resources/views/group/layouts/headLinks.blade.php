<title>{{ config('chatify.name') }}</title>

{{-- Meta tags --}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="id" content="{{ $id }}">
<meta name="type" content="{{ $type }}">
<meta charset="UTF-8">
<meta name="messenger-color" content="{{ $messengerColor }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url" content="{{ route('group.messanger') }}" data-user="{{ Auth::user()->id }}">
@include('layouts.include.head')
<title>{{ getSystemSetting('type_name') }} | {{ getSystemSetting('cms_title') }} - @yield('title') </title>
{{-- styles --}}
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/bootstrap.css">
<link rel='stylesheet' href="{{ asset('css/nprogress.css') }}" />
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/' . $dark_mode . '.mode.css') }}" rel="stylesheet" />


@livewireStyles
{{-- Messenger Color Style --}}
@include('messanger.layouts.messengerColor')

{{-- scripts --}}
<script src="{{ asset('/') }}/assets/js/jquery-3.5.1.js"></script>
<script src="{{ asset('/') }}/assets/js/bootstrap/bootstrap.bundle.js"></script>
<script src="{{ asset('/') }}/assets/js/bootstrap/popper.js"></script>

<script src="{{ asset('js/chatify/font.awesome.js') }}"></script>
<script src="{{ asset('js/fuse.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
<script src='{{ asset('js/nprogress.js') }}'></script>

<!-- Dropify -->
<script src="{{ asset('/') }}/assets/vendor/dropify/dropify.min.js"></script>

<script>
    "use strict"
    var big_image;

    $(document).ready(function() {


        window_width = $(window).width();

        $navbar = $('.navbar[color-on-scroll]');
        scroll_distance = $navbar.attr('color-on-scroll') || 500;

        $navbar_collapse = $('.navbar').find('.navbar-collapse');



        if ($('.navbar-color-on-scroll').length != 0) {
            $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);
        }




    });

    $(document).on('click', '.navbar-toggler', function() {
        $toggle = $(this);

        if (materialKit.misc.navbar_menu_visible == 1) {
            $('html').removeClass('nav-open');
            materialKit.misc.navbar_menu_visible = 0;
            $('#bodyClick').remove();
            setTimeout(function() {
                $toggle.removeClass('toggled');
            }, 550);

            $('html').removeClass('nav-open-absolute');
        } else {
            setTimeout(function() {
                $toggle.addClass('toggled');
            }, 580);


            div = '<div id="bodyClick"></div>';
            $(div).appendTo("body").click(function() {
                $('html').removeClass('nav-open');

                if ($('nav').hasClass('navbar-absolute')) {
                    $('html').removeClass('nav-open-absolute');
                }
                materialKit.misc.navbar_menu_visible = 0;
                $('#bodyClick').remove();
                setTimeout(function() {
                    $toggle.removeClass('toggled');
                }, 550);
            });

            if ($('nav').hasClass('navbar-absolute')) {
                $('html').addClass('nav-open-absolute');
            }

            $('html').addClass('nav-open');
            materialKit.misc.navbar_menu_visible = 1;
        }
    });



    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.



    // avatar preview

    function imageUpload(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#imagePreview").css(
                    "background-image",
                    "url(" + e.target.result + ")"
                );
                $("#imagePreview").hide();
                $("#imagePreview").fadeIn(350);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload").change(function() {
        imageUpload(this);
    });

    function imageUploadFIcon(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#imagePreview_f_icon").css(
                    "background-image",
                    "url(" + e.target.result + ")"
                );
                $("#imagePreview_f_icon").hide();
                $("#imagePreview_f_icon").fadeIn(350);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload_f_icon").change(function() {
        imageUploadFIcon(this);
    });

    function imageUploadFLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#imagePreview_f_logo").css(
                    "background-image",
                    "url(" + e.target.result + ")"
                );
                $("#imagePreview_f_logo").hide();
                $("#imagePreview_f_logo").fadeIn(650);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageUpload_f_logo").change(function() {
        imageUploadFLogo(this);
    });

    // Profile Avatar Photo Upload Priview
    $(document).ready(function () {
        $(".dropify").dropify();
    });
</script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<link rel="stylesheet"
      href="{{asset('css/bootstrap-material-design.css')}}" crossorigin="anonymous">

@livewireScripts


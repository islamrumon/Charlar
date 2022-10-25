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
<script src="{{ asset('/') }}/assets/js/jquery-3.5.1.min.js"></script>
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="{{ asset('js/fuse.js')}}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
<script src='{{ asset('js/nprogress.js') }}'></script>





<script>
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


</script>

{{-- styles --}}
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{asset('/')}}/assets/css/vendors/bootstrap.css">
<link rel='stylesheet' href="{{ asset('css/nprogress.css')}}" />
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/' . $dark_mode . '.mode.css') }}" rel="stylesheet" />
<link href="{{ asset('css/emojionearea.css') }}" rel="stylesheet" />

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<link rel="stylesheet"
    href="{{asset('css/bootstrap-material-design.min.css')}}" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/font-awesome.css">
<link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
<link rel="stylesgeet"
    href="{{asset('css/material-kit.css')}}">
<style>
  

    .h6,
    h6 {
        font-size: .75rem !important;
        font-weight: 500;
        font-family: Roboto, Helvetica, Arial, sans-serif;
        line-height: 1.5em;
        text-transform: uppercase;
    }

    .name h6 {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .navbar {
        border: 0;
        border-radius: 3px;
        padding: .625rem 0;
        margin-bottom: 20px;
        color: #555;
        background-color: #fff !important;
        box-shadow: 0 4px 18px 0 rgba(0, 0, 0, .12), 0 7px 10px -5px rgba(0, 0, 0, .15) !important;
        z-index: 1000 !important;
        transition: all 150ms ease 0s;

    }

    .navbar.navbar-transparent {
        z-index: 1030;
        background-color: transparent !important;
        box-shadow: none !important;
        padding-top: 25px;
        color: #fff;
    }

    .navbar .navbar-brand {
        position: relative;
        color: inherit;
        height: 50px;
        font-size: 1.125rem;
        line-height: 30px;
        padding: .625rem 0;
        font-weight: 300;
        -webkit-font-smoothing: antialiased;
    }

    .navbar .navbar-nav .nav-item .nav-link:not(.btn) .material-icons {
        margin-top: -7px;
        top: 3px;
        position: relative;
        margin-right: 3px;
    }

    .navbar .navbar-nav .nav-item .nav-link .material-icons {
        font-size: 1.25rem;
        max-width: 24px;
        margin-top: -1.1em;
    }

    .navbar .navbar-nav .nav-item .nav-link .fa,
    .navbar .navbar-nav .nav-item .nav-link .material-icons {
        font-size: 1.25rem;
        max-width: 24px;
        margin-top: 0px;
    }

    .navbar .navbar-nav .nav-item .nav-link {
        position: relative;
        color: inherit;
        padding: .9375rem;
        font-weight: 400;
        font-size: 12px;
        border-radius: 3px;
        line-height: 20px;
    }

   
    .fixed-top {
        position: fixed;
        z-index: 1030;
        left: 0;
        right: 0;
    }

    .profile-page .page-header {
        height: 380px;
        background-position: center;
    }

    .page-header {
        height: 100vh;
        background-size: cover;
        margin: 0;
        padding: 0;
        border: 0;
        display: flex;
        align-items: center;
    }

    .header-filter:after,
    .header-filter:before {
        z-index: 1;
        width: 100%;
        height: 100%;
        display: block;
        left: 0;
        top: 0;
        content: "";
    }

    .header-filter::before {
        background: rgba(0, 0, 0, .5);
    }

    .main-raised {
        margin: -60px 30px 0;
        border-radius: 6px;
        box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2);
    }

    .main {
        background: #FFF;
        position: relative;
        z-index: 3;
    }

    .profile-page .profile {
        text-align: center;
    }

    .profile-page .profile img {
        max-width: 160px;
        width: 100%;
        margin: 0 auto;
        -webkit-transform: translate3d(0, -50%, 0);
        -moz-transform: translate3d(0, -50%, 0);
        -o-transform: translate3d(0, -50%, 0);
        -ms-transform: translate3d(0, -50%, 0);
        transform: translate3d(0, -50%, 0);
    }

    .img-raised {
        box-shadow: 0 5px 15px -8px rgba(0, 0, 0, .24), 0 8px 10px -5px rgba(0, 0, 0, .2);
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .img-fluid,
    .img-thumbnail {
        max-width: 100%;
        height: auto;
    }

    .title {
        margin-top: 30px;
        margin-bottom: 25px;
        min-height: 32px;
        color: #3C4858;
        font-weight: 700;
        font-family: "Roboto Slab", "Times New Roman", serif;
    }

    .profile-page .description {
        margin: 1.071rem auto 0;
        max-width: 600px;
        color: #999;
        font-weight: 300;
    }

    p {
        font-size: 14px;
        margin: 0 0 10px;
    }

    .profile-page .profile-tabs {
        margin-top: 4.284rem;
    }

    .nav-pills,
    .nav-tabs {
        border: 0;
        border-radius: 3px;
        padding: 0 15px;
    }

    .nav .nav-item {
        position: relative;
        margin: 0 2px;
    }

    .nav-pills.nav-pills-icons .nav-item .nav-link {
        border-radius: 4px;
    }

    .nav-pills .nav-item .nav-link.active {
        color: #fff;
        background-color: #9c27b0;
        box-shadow: 0 5px 20px 0 rgba(0, 0, 0, .2), 0 13px 24px -11px rgba(156, 39, 176, .6);
    }

    .nav-pills .nav-item .nav-link {
        line-height: 24px;
        font-size: 12px;
        font-weight: 500;
        min-width: 100px;
        color: #555;
        transition: all .3s;
        border-radius: 30px;
        padding: 10px 15px;
        text-align: center;
    }

    .nav-pills .nav-item .nav-link:not(.active):hover {
        background-color: rgba(200, 200, 200, .2);
    }


    .nav-pills .nav-item i {
        display: block;
        font-size: 30px;
        padding: 15px 0;
    }

    .tab-space {
        padding: 20px 0 50px;
    }

    .profile-page .gallery {
        margin-top: 3.213rem;
        padding-bottom: 50px;
    }

    .profile-page .gallery img {
        width: 100%;
        margin-bottom: 2.142rem;
    }

    .profile-page .profile .name {
        margin-top: -80px;
    }

    img.rounded {
        border-radius: 6px !important;
    }

    .tab-content>.active {
        display: block;
    }

    /*buttons*/
    .btn {
        position: relative;
        padding: 12px 30px;
        margin: .3125rem 1px;
        font-size: .75rem;
        font-weight: 400;
        line-height: 1.428571;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0;
        border: 0;
        border-radius: .2rem;
        outline: 0;
        transition: box-shadow .2s cubic-bezier(.4, 0, 1, 1), background-color .2s cubic-bezier(.4, 0, .2, 1);
        will-change: box-shadow, transform;
    }

    .btn.btn-just-icon {
        font-size: 20px;
        height: 41px;
        min-width: 41px;
        width: 41px;
        padding: 0;
        overflow: hidden;
        position: relative;
        line-height: 41px;
    }

    .btn.btn-just-icon fa {
        margin-top: 0;
        position: absolute;
        width: 100%;
        transform: none;
        left: 0;
        top: 0;
        height: 100%;
        line-height: 41px;
        font-size: 20px;
    }

    .btn.btn-link {
        background-color: transparent;
        color: #999;
    }

    

    .show .dropdown-toggle:after {
        transform: rotate(180deg);
    }

    .dropdown-toggle:after {
        will-change: transform;
        transition: transform .15s linear;
    }





    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background: rgb(99, 39, 120);
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }

    .labels {
        font-size: 11px
    }

    .add-experience:hover {
        background: #BA68C8;
        color: #fff;
        cursor: pointer;
        border: solid 1px #BA68C8
    }


    /*avatar*/
    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 50px auto;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .avatar-upload .avatar-edit input+label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit input+label:after {
        content: "\f040";
        font-family: 'FontAwesome';
        color: #757575;
        position: absolute;
        top: 5px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .avatar-group {
        display: inline-flex;
    }

    .avatar-group .avatar {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 30px;
        font-size: 1rem;
        margin-left: -0.8rem;
        transition: transform 0.2s;
    }

    .avatar-group .avatar img {
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        border: 2px solid #ffffff;
    }

    .avatar-group .avatar:hover {
        -webkit-mask-image: none;
        mask-image: none;
        z-index: 1;
        transform: scale(1.1);
    }
</style>
{{-- Messenger Color Style --}}
@include('messanger.layouts.messengerColor')

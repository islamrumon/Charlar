<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
<link
    href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
    rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/simple-mde.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/font-awesome.css">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/icofont.css">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/themify.css">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/flag-icon.css">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/feather-icon.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/scrollbar.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/animate.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/date-picker.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/photoswipe.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/sweetalert2.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/owlcarousel.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/prism.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/whether-icon.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/image-cropper.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/select2.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/jsgrid.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/jkanban.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/datatables.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/rating.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/page-builder.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/slick-theme.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/slick.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/range-slider.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/dropzone.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/simple-mde.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/todo.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/tour.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/tree.css">
<!-- Plugins css Ends-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/button-builder.css">
<!-- Plugins css Ends-->


<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/calendar.css">
<!-- Plugins css Ends-->

<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/datatable-extension.css">
<!-- Plugins css Ends-->

<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/daterange-picker.css">
<!-- Plugins css Ends-->


<!-- Pnotify css -->
<link href="{{ asset('pnotify/css/pnotify.custom.css') }}" rel="stylesheet" type="text/css" />


<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/bootstrap.css">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/style.css">
<link id="color" rel="stylesheet" href="{{ asset('/') }}/assets/css/color-1.css" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/responsive.css">

<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/custom.css">


@livewireStyles


<style>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{getSystemSetting('type_name')}} - Install</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="{{ filePath(getSystemSetting('favicon_icon')) }}">
    <!-- Start CSS -->
    <link href="{{ filePath('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ filePath('assets/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ filePath('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ filePath('assets/css/flag-icon.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ filePath('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ filePath('css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- End CSS -->
</head>
<body class="vertical-layout">
<!-- Start Containerbar -->
<div id="containerbar" class="containerbar authenticate-bg" style="background-image: url({{ filePath('background_image.jpg') }});background-size: cover; background-position: center bottom; background-repeat: no-repeat;">
    <!-- Start Container -->
    <div class="container">
        <div class="auth-box login-box">
            <!-- Start row -->
            <div class="row no-gutters align-items-center justify-content-center">
                <!-- Start col -->
                <div class="col-md-8 col-lg-9">
                    <!-- Start Auth Box -->
                    <div class="auth-box-right">
                        @yield('content')
                    </div>
                    <!-- End Auth Box -->
                </div>
                <!-- End col -->
            </div>
            <!-- End row -->
        </div>
    </div>
    <!-- End Container -->
</div>
<!-- End Containerbar -->
<!-- Start JS -->
<script src="{{ filePath('assets/js/jquery.js') }}"></script>
<script src="{{ filePath('assets/js/popper.js') }}"></script>
<script src="{{ filePath('assets/js/bootstrap.js') }}"></script>
<script src="{{ filePath('assets/js/modernizr.js') }}"></script>
<script src="{{ filePath('assets/js/detect.js') }}"></script>
<script src="{{ filePath('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ filePath('js/script.js') }}"></script>
<!-- End js -->
</body>
</html>


<!DOCTYPE html>
<html lang="htmlLang()">

<head>
    @include('layouts.include.head')
    <title>{{ getSystemSetting('type_name') }} | {{ getSystemSetting('cms_title') }} - @yield('title') </title>
    @include('layouts.include.style')
    @yield('style')
</head>

<body>
    <!-- Loader starts-->
    @include('layouts.include.loader')
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('layouts.include.header')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->

            @include('layouts.include.sidebar')

            <!-- Page Sidebar Ends-->
            <div class="page-body">

                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h3>@yield('title')</h3>
                            </div>
                            <div class="col-12 col-sm-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"> <a class="home-item" href="{{ route('dashboard') }}"><i
                                                data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item"> @yield('title')</li>
                                    <li class="breadcrumb-item active"> @yield('sub-title')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                @include('layouts.include.error')
                @yield('main-content')
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright 2022 © Zeta theme by pixelstrap </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('layouts.include.script')
    @yield('script')

    @include('layouts.include.pnotify')
    @include('layouts.include.model')
    @include('layouts.include.delete')

</body>


</html>

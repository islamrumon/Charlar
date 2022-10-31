<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>{{ getSystemSetting('type_name') }} | {{ getSystemSetting('cms_title') }} - @yield('title') </title>
    @include('layouts.include.head')


    <link rel="stylesheet" href="{{ asset('landing_assets') }}/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('landing_assets') }}/css/fontawesome.min.css">

    <link rel="stylesheet" href="{{ asset('landing_assets') }}/css/flaticon.css">

    <link rel="stylesheet" href="{{ asset('landing_assets') }}/css/animate.css">

    <link rel="stylesheet" href="{{ asset('landing_assets') }}/css/slick.min.css">

    <link rel="stylesheet" href="{{ asset('landing_assets') }}/css/magnific-popup.css">

    <link rel="stylesheet" href="{{ asset('landing_assets') }}/css/style.css">

    <link rel="stylesheet" href="{{ asset('landing_assets') }}/css/responsive.css">
</head>

<body>

    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="cancel-preloader">
                <a href="#">Cancel Preloader</a>
            </div>
            <div class="lds-spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-area navbar-expand-lg absolute">
        <div class="container-fluid nav-container">
            <div class="logo-wrapper navbar-brand">
                <a href="{{ route('home') }}" class="logo">
                    {{-- <img src="{{ filePath(getSystemSetting('type_logo')) }}"
                        alt="{{ getSystemSetting('type_name') }}" /> --}}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="cgency">
                <ul class="navbar-nav" id="primary-menu">
                    @foreach (App\Http\Controllers\FrontendController::headerMenu()->items as $menu)
                        @if ($menu['child']->count() > 0)
                            <li class="nav-item active dropdown">
                                <a class="nav-link pl-0 dropdown-toggle" data-toggle="dropdown"
                                    href="{{ menuLink($menu->link) }}">{{ $menu->label }}
                                    <span class="sr-only">(current)</span>
                                </a>
                                <div class="dropdown-menu">
                                    @foreach ($menu['child'] as $child)
                                        <a href="{{ menuLink($child->link) }}"
                                            class="dropdown-item">{{ $child->label }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ menuLink($menu->link) }}" target="{{ $menu->target }}">
                                    {{ $menu->label }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="responsive-mobile-menu">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#cgency"
                    aria-controls="cgency" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="nav-right-content">
                <ul>
                    <li class="nav-btn">
                        <a href="{{ route(config('chatify.routes.prefix')) }}" class="boxed-btn blank">Open
                            {{ getSystemSetting('type_name') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    @yield('content')





    <footer class="footer-area footer-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget about_widget">
                        <a href="{{ route('home') }}" class="footer-logo"><img
                                src="{{ getSystemSetting('footer_logo') }}" alt=""></a>
                        <ul class="social-icon">
                            @if (getSystemSetting('type_fb') != '')
                                <li><a href="{{ getSystemSetting('type_fb') }}"><i class="fab fa-facebook-f"></i></a>
                                </li>
                            @endif
                            @if (getSystemSetting('type_tw') != '')
                                <li><a href="{{ getSystemSetting('type_tw') }}"><i class="fab fa-twitter"></i></a></li>
                            @endif
                            @if (getSystemSetting('type_google') != '')
                                <li><a href="{{ getSystemSetting('type_google') }}"><i
                                            class="fab fa-google-plus-g"></i></a></li>
                            @endif
                            @if (getSystemSetting('type_pinterest') != '')
                                <li><a href="{{ getSystemSetting('type_pinterest') }}"><i
                                            class="fab fa-pinterest-p"></i></a></li>
                            @endif
                        </ul>
                        <div class="copyright-text margin-top-30">{{ getSystemSetting('type_footer') }} </div>
                    </div>
                </div>
                @foreach (App\Http\Controllers\FrontendController::footerMenu()->items as $menu)
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget widget">
                            <h4 class="widget-title">{{ $menu->label }}</h4>
                            <ul>
                                @foreach ($menu['child'] as $child)
                                    <li><a href="{{ menuLink($child->link) }}">{{ $child->label }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </footer>

    <div class="back-to-top base-color-2">
        <i class="fas fa-rocket"></i>
    </div>

    <script src="{{ asset('landing_assets') }}/js/jquery.js"></script>

    <script src="{{ asset('landing_assets') }}/js/popper.min.js"></script>

    <script src="{{ asset('landing_assets') }}/js/bootstrap.min.js"></script>

    <script src="{{ asset('landing_assets') }}/js/slick.min.js"></script>

    <script src="{{ asset('landing_assets') }}/js/jquery.magnific-popup.js"></script>

    <script src="{{ asset('landing_assets') }}/js/wow.min.js"></script>

    <script src="{{ asset('landing_assets') }}/js/TweenMax.js"></script>

    <script src="{{ asset('landing_assets') }}/js/mousemoveparallax.js"></script>

    <script src="{{ asset('landing_assets') }}/js/contact.js"></script>

    <script src="{{ asset('landing_assets') }}/js/main.js"></script>
</body>

</html>

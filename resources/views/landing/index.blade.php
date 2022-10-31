@extends('landing.master')

@section('content')
    <div class="header-area header-bg" id="home">
        <div class="header-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="header-inner">
                            <h1 class="title wow FadeInDown">{{getSystemSetting('slider_title')}}</h1>
                            <p>{{getSystemSetting('slider_sub_title')}}</p>
                            <div class="btn-wrapper">
                                <a href="{{route(config('chatify.routes.prefix'))}}" class="boxed-btn gd-bg">{{getSystemSetting('slider_btn')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-right-image">
            <div class="header-right-image-animation">
                <img src="{{filePath(getSystemSetting('slider_right_image'))}}" alt="{{getSystemSetting('type_name')}}">
            </div>
        </div>
    </div>


    @include('landing.sections.about')

    @include('landing.sections.feature')
    @include('landing.sections.contact')


@endsection

@extends('layouts.app')

@section('title')
    @translate(Login Page)
@endsection
@section('main-content')
    @include('layouts.include.loader')

    <!-- page-wrapper Start-->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5">
                    <img class="bg-img-cover bg-center" src="{{ filePath(getSystemSetting('login_image')) }}"
                        alt="{{ getSystemSetting('type_name') }}">
                </div>
                <div class="col-xl-7 p-0">
                    <div class="login-card">
                        <form class="theme-form login-form" method="post" action="{{route('login')}}">
                            @csrf
                            <h4>@translate(Login)</h4>
                            <h6>@translate(Welcome back! Log in to your account).</h6>
                            <div class="form-group">
                                <label>@translate(Email Address)</label>
                                <div class="input-group"><span class="input-group-text"></span>
                                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" type="email" required placeholder="@translate(Enter Your Email)">
                                </div>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                            </div>
                            <div class="form-group">
                                <label>@translate(Password)</label>
                                <div class="input-group"><span class="input-group-text"></span>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" type="password" required
                                        placeholder="*********">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input name="remember" id="remember" type="checkbox">
                                    <label class="text-muted" for="remember">@translate(Remember password)</label>
                                    @if (Route::has('password.request'))
                                </div><a class="link" href="{{ route('password.request') }}">@translate(Forgot password?)</a>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">@translate(Sign in)</button>
                            </div>
                            <div class="login-social-title">
                                <h5>@translate(Sign in with)</h5>
                            </div>
                            <div class="form-group">
                                <ul class="login-social">
                                    <li><a href="https://www.linkedin.com/login" target="_blank"><i
                                                data-feather="linkedin"></i></a></li>
                                    <li><a href="https://twitter.com/" target="_blank"><i data-feather="twitter"></i></a>
                                    </li>
                                    <li><a href="https://www.facebook.com/" target="_blank"><i
                                                data-feather="facebook"></i></a></li>
                                    <li><a href="https://www.instagram.com/login" target="_blank"><i
                                                data-feather="instagram"> </i></a></li>
                                </ul>
                            </div>
                            @if (Route::has('password.request'))
                                <p>@translate(Donot have account)?<a class="ms-2"
                                        href="{{ route('register') }}">@translate(Create Account)</a></p>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page-wrapper end-->
@endsection

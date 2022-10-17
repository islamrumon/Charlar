
@extends('install.app')
@section('content')
    <div class="card">
        <div class="card-body">

            <div class="form-head">
                <img src="{{asset(getSystemSetting('type_logo'))}}" class="img-fluid" alt="logo">
            </div>

            <h1 class="h3">Congratulations!!!</h1>
            <p>You have successfully completed the installation process. Please Login to continue.</p>

            <a href="{{ \Illuminate\Support\Str::before(env('APP_URL'),'/public') }}" class="btn btn-primary btn-lg btn-block font-18">Start Using Now</a>
        </div>
    </div>
@endsection

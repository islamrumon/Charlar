@extends('layouts.master')
@section('title')
    @translate(Social login)
@endsection
@section('meta-desc')
    @translate(Social Login)
@endsection
@section('meta-keys')
    @translate(Social login)
@endsection
@section('main-content')
<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@translate(Facebook loign)</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body g-3">
                <form method="post" action="{{route('social.facebook.store')}}" enctype="multipart/form-data">
                    @csrf
                    <strong>For activate facebook login you need to configer facebook app, for more details goto developer.facebook.com</strong>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Facebook Login Active) <span class="text-danger">*</span></label>
                        <select class="form-control" required name="facebook_login_status">
                            <option value="No" {{ getSystemSetting('facebook_login_status') == 'No' ?'selected' : null }}>NO</option>
                            <option value="Yes"  {{ getSystemSetting('facebook_login_status') == 'Yes' ?'selected' : null }}>Yes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Facebook App Id) <span class="text-danger">*</span></label>
                        <input type="text" value="{{ env('facebook_client_id') }}" class="form-control" name="facebook_client_id">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Facebook App Secret) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  value="{{ env('facebook_client_secret') }}" name="facebook_client_secret">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Callback url) <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" readonly value="{{ route('facebook.callback') }}" name="facebook_redirect">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">@translate(Save)</button>
                </form>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@translate(Google loign)</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body g-3">
                <form method="post" action="{{route('social.google.store')}}" enctype="multipart/form-data">
                    @csrf
                    <strong>For activate facebook login you need to configer facebook app, for more details goto developer.facebook.com</strong>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Google Login Active) <span class="text-danger">*</span></label>
                        <select class="form-control" required name="google_login_status">
                            <option value="No" {{ getSystemSetting('google_login_status') == 'No' ?'selected' : null }}>NO</option>
                            <option  value="Yes" {{ getSystemSetting('google_login_status') == 'Yes' ?'selected' : null }}>Yes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Google App Id) <span class="text-danger">*</span></label>
                        <input type="text" value="{{ env('google_client_id') }}" class="form-control" name="google_client_id">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Google App Secret) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  value="{{ env('google_client_secret') }}" name="google_client_secret">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Callback url) <span class="text-danger">*</span></label>
                        <input type="url" class="form-control"  readonly value="{{ route('google.callback') }}" name="google_redirect">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">@translate(Save)</button>
                </form>
            </div>
        </div>
    </div>
@endsection

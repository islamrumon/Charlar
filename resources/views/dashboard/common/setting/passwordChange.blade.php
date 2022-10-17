@extends('layouts.master')
@section('title') @translate(Setting) @endsection
@section('main-content')
    <div class="contentbar">

        <div class="card m-2">
            <div class="card-header">
                <h2 class="card-title">@translate(Update Your.update)</h2>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('change.password.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">


                            <div class="form-group mb-5">
                                <label>@translate(Old Password) *</label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                    name="old_password" required>
                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <hr>
                            <div class="form-group mb-5">
                                <label>@translate(New Password) *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group  mb-5">
                                <label>@translate(Confirm Password) *</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password" required>
                            </div>

                        </div>
                        <div class="col-md-6">





                        </div>
                    </div>


                    <div class="m-2 text-center">
                        <button class="btn btn-block btn-primary" type="submit">@translate(Update)</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



@endsection

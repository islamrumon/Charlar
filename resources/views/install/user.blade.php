@extends('install.app')
@section('content')

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.store') }}" class="text-left">
                @csrf
                <div class="form-head text-center">
                    <img src="{{asset(getSystemSetting('type_logo'))}}" class="img-fluid" alt="logo">
                </div>
                <h4 class="ont-weight-bold text-center my-4">Create Admin User</h4>
                <div class="form-group">
                    <label for="name" class="col-form-label text-md-right">@translate(Name)</label>


                    <input placeholder="Enter UserName" id="name" type="text"
                           class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="email" class="col-form-label text-md-right">@translate(E-Mail Address)</label>


                    <input id="email" placeholder="Enter Email" type="email"
                           class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="password" class=" col-form-label text-md-right">@translate(Password)</label>


                    <input id="password" placeholder="Enter Password" type="password"
                           class="form-control @error('password') is-invalid @enderror" name="password" required
                           autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

                <div class="form-group ">
                    <label for="password-confirm" class="col-form-label text-md-right">@translate(Confirm
                        Password)</label>


                    <input id="password-confirm" placeholder="Enter Confirm Password" type="password"
                           class="form-control" name="password_confirmation" required autocomplete="new-password">

                </div>

                <div class="">
                    <button class="btn btn-primary btn-lg btn-block font-18" type="submit">Register</button>
                </div>
            </form>

        </div>
    </div>


@endsection

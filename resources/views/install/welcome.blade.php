@extends('install.app')
@section('content')

    <div class="card">
        <div class="card-body">

                <div class="form-head">
                    <img src="{{asset(getSystemSetting('type_logo'))}}" class="img-fluid" alt="logo">
                </div>

                <h1 class="font-weight-bold">CMS Installation</h1>
                <h5>You will need to know the following items before proceeding</h5>

            <ul class="list-group">
                <li class="list-group-item">
                    <h6 class="font-weight-normal">
                        <i class="fa fa-check"></i> Database Host Name</h6>
                </li>
                <li class="list-group-item">
                    <h6 class="font-weight-normal">
                        <i class="fa fa-check"></i> Database Name</h6>
                </li>
                <li class="list-group-item">
                    <h6 class="font-weight-normal">
                        <i class="fa fa-check"></i> Database User Name</h6>
                </li>
                <li class="list-group-item">
                    <h6 class="font-weight-normal">
                        <i class="fa fa-check"></i> Database Password</h6>
                </li>
            </ul>

            <p>During the installation process. we will check if the files there needed to be written (<strong>.env file</strong>)
                have <strong>write permission</strong>. We Will also check if
                <strong>curl</strong> are enabled on your server or not.</p>
            <br>
            <p>Gather the information mentioned above before hitting the start installation button. if you are ready...</p>

            <div class="login-or">
                <h6 class="text-muted">OR</h6>
            </div>
            <a href="{{route('permission')}}" class="btn btn-primary btn-lg btn-block font-18"> Start Installation Process</a>
        </div>
    </div>


@endsection

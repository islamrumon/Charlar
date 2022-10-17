@extends('install.app')
@section('content')

    <div class="card">
        <div class="card-body">

            <div class="form-head">
                <img src="{{asset(getSystemSetting('type_logo'))}}" class="img-fluid" alt="logo">
            </div>

            @if($message = Session::get('success'))

                <div class="card-body">
                    <h3 class="text-lg-center p-3">
                        @translate(Import Sql)</h3>
                    <p>
                        @translate(If You Click this button Sql File auto Save in Database)</p>
                    <a href="{{route('org.create')}}" class="btn btn-primary btn-lg btn-block font-18">
                        @translate(Import Sql)</a>
                </div>

            @endif

            @if($message = Session::get('wrong'))

                <div class="card-body">
                    <p>
                        @translate(Check the Database connection)</p>
                    <a href="{{route('create')}}" class="btn btn-danger btn-lg btn-block font-18">
                        @translate(Go to the Database Setup)</a>
                </div>

            @endif
        </div>
    </div>


@endsection

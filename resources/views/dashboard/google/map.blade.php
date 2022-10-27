@extends('layouts.master')
@section('title') @translate(Google map Setting) @endsection
@section('sub-title')
    <a class="nav=link" href="{{ route('dashboard') }}">
        @translate(Dashboard)
    </a>
@endsection
@section('main-content')
    <div class="contentbar">
        <div class="card m-2">
            <div class="card-body">
                <form method="post" action="{{ route('google.map.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">

                            <label class="label">@translate(Google Map)</label><br>
                            <strong>@translate(if google map api is activated), @translate(all map service is avaliable)</strong>
                            <input type="text" value="{{ getSystemSetting('google_map') }}" name="google_map"
                                class="form-control">





                        </div>

                    </div>


                    <div class="m-2 text-center">
                        <button class="btn btn-block btn-primary" type="submit">@translate(Save)</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



@endsection

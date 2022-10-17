@extends('layouts.master')
@section('title') @translate(Setting) @endsection
@section('main-content')
    <div class="contentbar">

        <div class="card m-2">
            <div class="card-header">
                <h2 class="card-title">@translate(Google map Setting)</h2>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('google.map.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">

                            <label class="label">@translate(Google map api key)</label><br>
                            <strong>@translate(if google map api is activated), @translate(all map service is avaliable)</strong>
                            <input type="text" value="{{ getSystemSetting('google_Key') }}" name="google_Key"
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

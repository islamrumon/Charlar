@extends('layouts.master')
@section('title') @translate(Firebase Setup) @endsection
@section('main-content')
    <div class="card ">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Firebase Setup)</h2>
            </div>
            <div class="float-right">

            </div>
        </div>

        <div class="card-body">
            <form action="{{route('google.firebase.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <strong>@translate(For get right data setup Firebase properly)</strong>


                <div class="form-group">
                    <label>@translate(Api Key) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('apiKey') }}" type="text"  name="apiKey" required>
                </div>

                <div class="form-group">
                    <label>@translate(Auth Domain) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('authDomain') }}" type="text"  name="authDomain" required>
                </div>


                <div class="form-group">
                    <label>@translate(Database Url) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('databaseURL') }}" type="text"  name="databaseURL" required>
                </div>

                <div class="form-group">
                    <label>@translate(Project Id) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('projectId') }}" type="text"  name="projectId" required>
                </div>

                <div class="form-group">
                    <label>@translate(Storage Bucket) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('storageBucket') }}" type="text"  name="storageBucket" required>
                </div>

                <div class="form-group">
                    <label>@translate(Messaging Sender Id) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('messagingSenderId') }}" type="text"  name="messagingSenderId" required>
                </div>

                <div class="form-group">
                    <label>@translate(App Id) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('appId') }}" type="text"  name="appId" required>
                </div>

                <div class="form-group">
                    <label>@translate(Measurement Id) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('measurementId') }}" type="text"  name="measurementId" required>
                </div>


                <div class="float-right">
                    <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
                </div>

            </form>
        </div>
    </div>
@endsection



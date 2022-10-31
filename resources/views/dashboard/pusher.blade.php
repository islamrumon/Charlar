@extends('layouts.master')
@section('title')
    @translate(Pusher  Settting)
@endsection
@section('meta-desc')
    @translate(Pusher  Settting)
@endsection
@section('meta-keys')
    @translate(Pusher  Settting)
@endsection
@section('main-content')
<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@translate(Pusher setup)</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body g-3">
                <form method="post" action="{{route('pusher.sdk.store')}}" enctype="multipart/form-data">
                    @csrf
                    <strong>For more information visit <a href="https://pusher.com">link</a></strong>
                    

                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(PUSHER APP ID) <span class="text-danger">*</span></label>
                        <input type="text" value="{{ env('PUSHER_APP_ID') }}" class="form-control" name="PUSHER_APP_ID">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(PUSHER APP KEY) <span class="text-danger">*</span></label>
                        <input type="text" value="{{ env('PUSHER_APP_KEY') }}" class="form-control" name="PUSHER_APP_KEY">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(PUSHER APP SECRET) <span class="text-danger">*</span></label>
                        <input type="text" value="{{ env('PUSHER_APP_SECRET') }}" class="form-control" name="PUSHER_APP_SECRET">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(PUSHER HOST) <span class="text-danger">*</span></label>
                        <input type="text" value="{{ env('PUSHER_HOST') }}" class="form-control" name="PUSHER_HOST">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(PUSHER PORT) <span class="text-danger">*</span></label>
                        <input type="text" value="{{ env('PUSHER_PORT') }}" class="form-control" name="PUSHER_PORT">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(PUSHER SCHEME) <span class="text-danger">*</span></label>
                        <input type="text" value="{{ env('PUSHER_SCHEME') }}" class="form-control" name="PUSHER_SCHEME">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(PUSHER APP CLUSTER) <span class="text-danger">*</span></label>
                        <input type="text" value="{{ env('PUSHER_APP_CLUSTER') }}" class="form-control" name="PUSHER_APP_CLUSTER">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">@translate(Save)</button>
                </form>
            </div>
        </div>
       
    </div>
@endsection

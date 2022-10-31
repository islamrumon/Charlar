@extends('layouts.master')
@section('title')
    @translate(Brodcasting  Settting)
@endsection
@section('meta-desc')
    @translate(Brodcasting  Settting)
@endsection
@section('meta-keys')
    @translate(Brodcasting  Settting)
@endsection
@section('main-content')
<div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@translate(Agora Brodcasting setup)</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body g-3">
                <form method="post" action="{{route('agora.sdk.store')}}" enctype="multipart/form-data">
                    @csrf
                    <strong>For more information visit <a href="https://www.agora.io/">link</a></strong>
                    

                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Agora App Id) <span class="text-danger">*</span></label>
                        <input type="text" value="{{ env('agora_app_id') }}" class="form-control" name="agora_app_id">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Agora App Certificate) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  value="{{ env('agora_app_certificate') }}" name="agora_app_certificate">
                    </div>


                    <button type="submit" class="btn btn-primary mt-3">@translate(Save)</button>
                </form>
            </div>
        </div>
       
    </div>
@endsection

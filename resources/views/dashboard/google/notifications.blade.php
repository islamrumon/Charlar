@extends('layouts.master')
@section('title') @translate(Send Push Notification) @endsection
@section('main-content')
    <div class="card ">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Send Push Notification)</h2>
            </div>
            <div class="float-right">
                Recommended: 256x256 for image
            </div>
        </div>

        <div class="card-body">
            <form action="{{route('google.push.notify.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>@translate(Title) <span class="text-danger">*</span></label>
                    <input class="form-control" name="title" placeholder="@translate(title)" required>
                </div>

                <div class="form-group">
                    <label>@translate(body) <span class="text-danger">*</span></label>
                    <textarea name="body" class="form-control"></textarea>

                </div>

                <div class="form-group">
                    <label>@translate(Image)</label>
                    <input class="form-control-file" name="image" type="file" >
                </div>

                <div class="float-right">
                    <button class="btn btn-primary float-right" type="submit">@translate(Send)</button>
                </div>
            </form>
        </div>
    </div>


@endsection



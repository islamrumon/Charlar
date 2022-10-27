@extends('layouts.master')
@section('title') @translate(Send Push Notification) @endsection
@section('sub-title')
    <a class="nav=link" href="{{ route('dashboard') }}">
        @translate(Dashboard)
    </a>
@endsection

@section('main-content')
    <div class="card ">
        <div class="card-header">
            <div class="float-right">
                @translate(Recommended: 256x256 for image)
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
                    <label>@translate(Message ) <span class="text-danger">*</span></label>
                    <textarea name="body" class="form-control" placeholder="Ex: today is 20% offer"></textarea>

                </div>

                <div class="form-group mt-2">
                    <label>@translate(Image)</label>
                    <input class="form-control" name="image" type="file" >
                </div>

                <div class="float-right mt-3">
                    <button class="btn btn-primary float-right" type="submit">@translate(Send)</button>
                </div>
            </form>
        </div>
    </div>


@endsection



@extends('layouts.master')
@section('title')
    @translate(Page Content Create)
@endsection

@section('sub-title')
    <a class="nav=link" href="{{ route('pages.content.index', $id) }}">
        @translate(Page Content list)
    </a>
@endsection
@section('main-content')
    <div class="card ">
        <div class="card-header">
            <a href="{{ route('pages.content.index', $id) }}" class="btn btn-primary">
                @translate(Content List)
            </a>
        </div>

        <div class="card-body g-3">
            <form action="{{ route('pages.content.store', $id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input name="page_id" type="hidden" value="{{ $id }}">

                <div class="form-group">
                    <label>@translate(Content Title) <span class="text-danger">*</span></label>
                    <input placeholder="@translate(Enter Content Title)" class="form-control @error('title') is-invalid @enderror"
                        type="text" value="{{ old('title') }}" name="title">
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="val-suggestions">
                        @translate(Content Description)</label>
                    <textarea  class="form-control @error('body') is-invalid @enderror" name="body" rows="5">{{ old('body') }}</textarea>
                    @error('body')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary" type="submit">@translate(Save)</button>
                </div>

            </form>
        </div>
    </div>
@endsection

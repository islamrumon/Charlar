@extends('layouts.master')
@section('title')
    @translate(Page Content Edit)
@endsection

@section('sub-title')
    <a class="nav=link" href="{{ route('pages.content.index', $id) }}">
        @translate(Page Content list)
    </a>
@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pages.content.index', $id) }}" class="btn btn-primary">
                @translate(Content List)
            </a>
        </div>

        <div class="card-body">
            <div class="card-body">
                <form action="{{ route('pages.content.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input name="id" type="hidden" value="{{ $content->id }}">
                    <input name="page_id" type="hidden" value="{{ $content->page_id }}">
                    <div class="form-group">
                        <h4>@translate(Content Title) <span class="text-danger">*</span></h4>
                        <input class="form-control @error('title') is-invalid @enderror" type="text"
                            value="{{ $content->title }}" name="title" required>
                    </div>

                    <div class="form-group">
                        <h4 class="col-form-label" >
                            @translate(Content Description)</h4>
                        <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="5">{{ $content->body }}</textarea>
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
    </div>
@endsection

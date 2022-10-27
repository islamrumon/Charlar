@extends('layouts.master')
@section('title')
    @translate(Post Create)
@endsection

@section('sub-title')
    <a class="nav=link" href="{{ route('blog.post.index') }}">
        @translate(Posts)
    </a>
@endsection
@section('main-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="card m-2">
            <div class="card-body">

                <form method="post" action="{{ route('blog.post.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Title) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="@translate(Enter the title)">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Select Category)
                            <span class="text-danger">*</span></label>
                        <select class="form-control " name="category_id">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}"> {{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">@translate(Descriptions) <span class="text-danger">*</span></label>
                        <textarea class="form-control editable" name="desc"></textarea>
                    </div>

                    <div class="form-group">
                        <label>@translate(Tags)</label>
                        <input id="tagsinput-default" class="form-control" data-role="tagsinput" name="tags"
                            placeholder="@translate(Post Tags)" type="text">
                    </div>


                    <div class="form-group">
                        <label>@translate(Image) <span class="text-danger">*</span></label>
                        <input class="form-control-file" name="image" type="file">
                      
                    </div>





                    <div class="border-primary">
                        <div class="form-group">
                            <label>@translate(Meta Title)</label>
                            <input class="form-control" name="meta_title" type="text" max="100"
                                placeholder="@translate(Meth Title)">
                            <small class="text-info">@translate(Google standard 100 characters)</small>
                        </div>

                        <div class="form-group">
                            <label>@translate(Meta Keywords)</label>
                            <input class="form-control" name="meta_key" type="text" max="100"
                                placeholder="@translate(Meth Key)">
                            <small class="text-info">@translate(Google standard 100 characters)</small>
                        </div>

                        <div class="form-group">
                            <label>@translate(Meta Description)</label>
                            <textarea class="form-control" name="meta_desc" maxlength="200" placeholder="@translate(Meta Description write)"></textarea>
                            <small class="text-info">@translate(Google standard 200 characters)</small>
                        </div>

                    </div>


                    <button type="submit" class="btn btn-primary">@translate(Save)</button>
                </form>

            </div>
        </div>
    </div>
@endsection

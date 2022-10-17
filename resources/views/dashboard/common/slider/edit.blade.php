<div class="card-body">
    <form action="{{route('slider.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$slider->id}}">
        <div class="form-group">
            <label>@translate(Url)</label>
            <input class="form-control" value="{{$slider->url}}" name="url" placeholder="@translate(Url)">
        </div>

        @if($slider->image != null)
            <div class="form-group">
                <div class="m-3">
                    <img src="{{filePath($slider->image)}}" class="img-container" width="100" height="80">
                </div>
            </div>
        @endif

        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Image)</label>
            <div class="">
                <input class="form-control-file sr-file" required
                       placeholder="@translate(Choose Image  only)" name="image" type="file">
                <small class="text-info">@translate(Upload file support png, jpg, svg format)</small>
            </div>
        </div>


        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>

<div class="card-body">
    <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>@translate(Url)</label>
            <input class="form-control" name="url" placeholder="@translate(Url)">
        </div>



        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Image)</label>
            <div class="">
                <input class="form-control-file sr-file" required
                       placeholder="@translate(Choose Image  only)"   name="image" type="file">
                <small class="text-info">@translate(Upload file support png, jpg, svg format)</small>
            </div>
        </div>


        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>





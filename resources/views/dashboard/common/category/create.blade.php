<div class="card-body">
    <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>@translate(Name) <span class="text-danger">*</span></label>
            <input class="form-control" name="name" placeholder="@translate(Name)" required>
        </div>

        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Icon image)</label>
            <div class="custom-file">
                <input class="form-control-file sr-file"   name="icon" type="file">
                <small class="text-info">@translate(Upload file support png, jpg, svg format)</small>
            </div>
        </div>

        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Image)</label>
            <div class="">
                <input class="form-control-file sr-file" placeholder="@translate(Choose Image  only)"   name="image" type="file">
                <small class="text-info">@translate(Upload file support png, jpg, svg format)</small>
            </div>
        </div>

        <div class="form-group">
            <label>@translate(Parent Category)</label>
            <select class="form-control select2 w-100" name="parent_category_id">
                <option value="">@translate(No Parent Category Select)</option>
                @foreach($categories as $item)
                    <option value="{{$item->id}}" class="text-primary">(*)  {{ transPhp('category_name',$item->name)}}</option>

                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>@translate(Meta Keywords)</label>
            <input class="form-control" name="meta_keys" type="text" max="100" placeholder="@translate(Meth Title)">
            <small class="text-info">@translate(Google standard 100 characters)</small>
        </div>

        <div class="form-group">
            <label>@translate(Meta Description)</label>
            <textarea class="form-control" name="meta_desc" maxlength="200" placeholder="@translate(Meta Description write)"></textarea>
            <small class="text-info">@translate(Google standard 200 characters)</small>
        </div>

        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>




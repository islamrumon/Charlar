<div class="card-body">
    <form action="{{route('categories.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$category->id}}">
        <input type="hidden" name="image" value="{{$category->image}}">
        <div class="form-group">
            <label>@translate(Name) <span class="text-danger">*</span></label>
            <input class="form-control" name="name" placeholder="@translate(Name)" required value="{{$category->name}}">
        </div>

        @if($category->icon != null)
        <img src="{{filePath($category->icon)}}" width="80" height="80" class="img-thumbnail">
    @endif
        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Icon image)</label>
            <div class="custom-file">
                <input class="form-control-file sr-file"   name="icon" type="file">
                <small class="text-info">@translate(Upload file support png, jpg, svg format)</small>
            </div>
        </div>

        @if($category->image != null)
            <img src="{{filePath($category->image)}}" width="80" height="80" class="img-thumbnail">
        @endif
        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Image)</label>
            <div class="">
                <input class="form-control-file sr-file" placeholder="@translate(Choose Image  only)"   name="newImage" type="file">
                <small class="text-info">@translate(Upload file support png, jpg, svg format)</small>
            </div>
        </div>

        <div class="form-group">
            <label>@translate(Parent Category)</label>
            <select class="form-control kt-select2 width-full" id="kt_select2_3" name="parent_category_id">
                <option value="0">@translate(No Parent Category Select)</option>
                @foreach($categories as $item)
                    <option value="{{$item->id}}" {{$category->parent_category_id == $item->id ? 'selected': null}} class="text-primary">(*)  {{ $item->name}}</option>

                @endforeach

            </select>
        </div>


        <div class="form-group">
            <label>@translate(Meta Title)</label>
            <input class="form-control" name="meta_title" value="{{$category->meta_title}}" type="text" max="100" placeholder="@translate(Meth Title)">
            <small class="text-info">@translate(Google standard 100 characters)</small>
        </div>

        <div class="form-group">
            <label>@translate(Meta Description)</label>
            <textarea class="form-control" name="meta_desc" maxlength="200" placeholder="@translate(Meta Description write)">{{$category->meta_desc}}</textarea>
            <small class="text-info">@translate(Google standard 200 characters)</small>
        </div>

        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Update)</button>
        </div>

    </form>
</div>




<div class="card-body">
    <form action="{{route('menu.item.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $item->id }}"/>
        <div class="form-group">
            <label>@translate(Label) <span class="text-danger">*</span></label>
            <input class="form-control" value="{{ $item->label }}" name="label" placeholder="@translate(Lable)" required>
        </div>

        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Link)</label>
            <div class="">
                <input class="form-control"  name="link" type="url" value="{{ $item->link }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Icon)</label>
            <div class="">
                <input class="form-control-file sr-file" placeholder="@translate(Choose icon Image  only)"   name="icon" type="file">
                <small class="text-info">@translate(Upload file support png, jpg, svg format)</small>
            </div>
        </div>

        @if ($item->icon != null)
                 <div class="text-center">
                <img src="{{ filePath($item->icon) }}" width="80px" height="80px" class="img-fluid" />
                 </div>
        @endif

        <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Image)</label>
            <div class="">
                <input class="form-control-file sr-file" placeholder="@translate(Choose Image  only)"   name="image" type="file">
                <small class="text-info">@translate(Upload file support png, jpg, svg format)</small>
            </div>
        </div>

        @if ($item->image != null)
                 <div class="text-center">
                <img src="{{ filePath($item->image) }}" width="100px" height="80px" class="img-fluid" />
                 </div>
        @endif


        <div class="form-group">
            <label>@translate(Status)</label>
            <select class="form-control select2 w-100" name="is_published">
                <option value="1" {{ $item->is_published ? 'selected': null }} class="text-danger">@translate(Published)</option>
                <option value="0" {{ !$item->is_published ? 'selected': null }} class="text-danger">@translate(UnPublished)</option>
            </select>
        </div>

        <div class="form-group">
            <label>@translate(Icon class)</label>
            <input class="form-control" value="{{ $item->icon_class }}" name="icon_class" type="text" placeholder="@translate(Icon class)">

        </div>


{{-- <div class=""></div> --}}
        {{-- <div class="float-right"> --}}
            <button class="btn btn-primary mt-2 pr-5" type="submit">@translate(Save)</button>
        {{-- </div> --}}

        {{-- <div class="float-left"> --}}
            <button class="btn btn-outline-danger pl-5 mt-2" value="delete" name="delete" type="submit">@translate(Delete)</button>
        {{-- </div> --}}

    </form>
</div>




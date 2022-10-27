<div class="card-body">
    <form action="{{route('pages.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>@translate(Page Title) <span class="text-danger">*</span></label>
            <input class="form-control" placeholder="@translate(Page Title)" type="text"  name="title" required>
        </div>

        <div class="form-group">
            <label>@translate(Select widgets) </label>
            <select class="select2 form-control" name="widgets[]" multiple> 
                <option value="">@translate(Select the widget)</option>
                @foreach (config('widgets') as $key => $value)
                <option value="{{$key}}"> {{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="float-right mt-3">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>






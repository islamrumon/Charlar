<div class="card-body">
    <form action="{{ route('pages.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $page->id }}">
        <div class="form-group">
            <label>@translate(Page Title) <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="title" value="{{ $page->title }}" required>
        </div>


        <div class="form-group">
            <label>@translate(Select widgets) </label>
            <select class="select2 form-control" name="widgets[]" multiple>
                <option value="">@translate(Select the widget)</option>

                @foreach (config('widgets') as $key => $value)
                    <option value="{{ $key }}"
                        @if ($page->widgets != null) @foreach (json_decode($page->widgets) as $item1)
                    @if ($key == $item1)
                        selected @endif
                        @endforeach
                @endif
                >{{ $value }}</option>
                @endforeach

            </select>
        </div>


        <div class="float-right mt-3">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>

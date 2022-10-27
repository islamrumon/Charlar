<form method="post" action="{{route('blog.categories.update')}}">
    @csrf
    <input type="hidden" name="id" value="{{$category->id}}">
    <div class="form-group">
        <label for="exampleInputEmail1">@translate(Title)</label>
        <input type="text" class="form-control"
        name="title" value="{{$category->title}}"
        placeholder="@translate(Enter the title)">
    </div>
    <button type="submit" class="btn btn-primary mt-2">@translate(Save)</button>
</form>

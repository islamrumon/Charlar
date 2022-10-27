@extends('layouts.master')
@section('title')
    @translate(Blog Categories)
@endsection
@section('meta-desc')
    @translate(Blog Categories)
@endsection
@section('meta-keys')
    @translate(Blog Categories)
@endsection

@section('sub-title')
    <a class="nav=link" href="{{ route('blog.post.index') }}">
        @translate(Posts)
    </a>
@endsection

@section('main-content')
    <div class="contentbar">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body p-2">
                <!-- there are the main content-->
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">@translate(Blog Categories)</h2>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@translate(Title)</th>
                                            <th scope="col">@translate(Published)</th>
                                            <th scope="col">@translate(Action)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ $item->title }}<br>
                                                    {{ $item->slug }}
                                                </td>
                                                <td>
                                                    <div class="media-body text-end">
                                                        <label class="switch" for="customSwitch{{ $item->id }}">
                                                            <input data-id="{{ $item->id }}"
                                                                id="customSwitch{{ $item->id }}"
                                                                {{ $item->is_published == true ? 'checked' : null }}
                                                                data-url="{{ route('blog.categories.published') }}"
                                                                type="checkbox">
                                                            <span class="switch-state"></label>

                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary" href="#!"
                                                        onclick="forModal('{{ route('blog.categories.edit', $item->id) }}', '@translate(Update)')">
                                                        <i class="feather icon-edit mr-2"></i>@translate(Edit)</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">

                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">@translate(Blog Category Create)</h2>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('blog.categories.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">@translate(Title)</label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="@translate(Enter the title)">
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">@translate(Save)</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')
@section('title')
    @translate(Blog posts )
@endsection

@section('sub-title')
    <a class="nav=link" href="{{ route('blog.post.create') }}">
        @translate(Post Create)
    </a>
@endsection
@section('main-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="card m-2">
            <div class="card-header">
                <a href="{{ route('blog.post.create') }}" class="btn btn-success">@translate(Create a blog post)</a>
            </div>

            <div class="card-body">
                <table class="table table-striped- table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>@translate(S / L)</th>
                            <th class="text-left">@translate(Image)</th>
                            <th class="text-left">@translate(Title)</th>
                            <th>@translate(Author)</th>
                            <th>@translate(Popular)
                            </th>
                            <th>@translate(Published)</th>
                            <th>@translate(Action)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as  $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td class="text-left">
                                    <img src="{{ filePath($item->image) }}" class="img-round" width="90px"
                                        height="90px" />
                                </td>
                                <td class="text-left">
                                    <p>@translate(Title) : {{ $item->title }}</p><br>
                                    <p>@translate(Slug) : <a href="{{ route('blog.post.details', $item->slug) }}"
                                            class="nav-link">{{ checkNull($item->slug) }}</a></p>
                                </td>
                                <td>
                                    {{ $item->author->name }}
                                </td>
                                <td>

                                    <div class="media-body text-end">
                                        <label class="switch" for="customSwitch{{ $item->id }}">
                                            <input data-id="{{ $item->id }}" id="customSwitch{{ $item->id }}"
                                                {{ $item->is_popular == true ? 'checked' : null }}
                                                data-url="{{ route('blog.post.popular') }}" type="checkbox">
                                            <span class="switch-state"></label>

                                    </div>
                                </td>
                                <td >
                                    <div class="media-body text-end">
                                        <label class="switch" for="customSwit{{ $item->id }}">
                                            <input data-id="{{ $item->id }}" id="customSwit{{ $item->id }}"
                                                {{ $item->is_published == true ? 'checked' : null }}
                                                data-url="{{ route('blog.post.published') }}" type="checkbox">
                                            <span class="switch-state"></label>
                                    </div>
                                </td>

                                <td>

                                    <div class="btn-group mr-2">
                                        <a class="btn btn-sm btn-success" target="_blank"
                                            href="{{ route('blog.post.details', $item->slug) }}">
                                            @translate(Show)</a>


                                        <a class="btn btn-primary" href="{{ route('blog.post.edit', $item->id) }}">
                                            @translate(Edit)</a>

                                        <a class="btn btn-danger" href="{{ route('blog.post.delete', $item->id) }}">
                                            @translate(Delete)</a>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <h3 class="text-center">@translate(No Data Found)</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>


            </div>
        </div>
    </div>
@endsection

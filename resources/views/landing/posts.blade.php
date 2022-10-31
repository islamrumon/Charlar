@extends('landing.master')
@section('title')
    @translate(Latest posts)
@endsection

@section('meta_desc')
    {{ getSystemSetting('meta_desc') }}
@endsection

@section('meta_keys')
    {{ getSystemSetting('meta_keys') }}
@endsection

@section('meta_title')
    {{ getSystemSetting('meta_title') }}
@endsection


@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="page-title">Latest posts</h1>
                        <ul class="page-list">
                            <li class="active"><a href="{{ route('home') }}">Home</a></li>
                            <li>Posts</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-page-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @foreach ($posts as $item)
                            <div class="col-lg-6 col-md-6">
                                <div class="single-blog-grid margin-bottom-30">
                                    <div class="thumb">
                                        <img src="{{ filePath($item->image) }}" width="349px" height="280px"
                                            alt="{{ $item->slug }}" />
                                    </div>
                                    <div class="content">
                                        <ul class="post-meta">
                                            <li>
                                                <a href="{{ route('blog.post.details', $item->slug) }}"><i
                                                        class="far fa-calendar-alt"></i>
                                                    {{ dateTimeFormat($item->created_at) }}</a>
                                            </li>
                                            @if ($item->author != null)
                                                <li>
                                                    <a href="{{ route('blog.post.details', $item->slug) }}"><i
                                                            class="far fa-user"></i> By {{ $item->author->name }}</a>
                                                </li>
                                            @endif
                                        </ul>
                                        <h3 class="title">
                                            <a
                                                href="{{ route('blog.post.details', $item->slug) }}">{{ $item->title }}</a>
                                        </h3>

                                        <a href="{{ route('blog.post.details', $item->slug) }}" class="readmore">Read
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12">
                            @if ($posts->count() > 0)
                                <div class="buxkit-blog-pagination margin-top-20">
                                    {{ $posts->links('vendor.pagination.default') }}
                                </div>
                                
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar widget-area">
                        @if ($categories->count() > 0)
                            <div class="widget widget_categories">
                                <h4 class="widget-title">Categories</h4>
                                <ul>
                                    @foreach ($categories as $cat)
                                        <li class="cat-item"><a
                                                href="{{ route('category.post', $cat->slug) }}">{{ $cat->title }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        @endif
                        @if ($popularPosts->count() > 0)
                            <div class="widget widget_popular_posts">
                                <h4 class="widget-title">Popular Posts</h4>
                                <ul>
                                    @foreach ($popularPosts as $popular)
                                        <li class="single-popular-post-item">
                                            <div class="thumb">
                                                <img src="{{ filePath($popular->image) }}" width="80px" height="70px"
                                                    alt="{{ $popular->slug }}" />
                                            </div>
                                            <div class="content">
                                                <span class="time">{{ dateTimeFormat($popular->created_at) }}</span>
                                                <h4 class="title">
                                                    <a
                                                        href="{{ route('blog.post.details', $popular->slug) }}">{{ $popular->title }}</a>
                                                </h4>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

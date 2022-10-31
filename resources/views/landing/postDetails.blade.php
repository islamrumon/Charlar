@extends('landing.master')
@section('title')
    {{ $post->title }}
@endsection

@section('meta_desc')
    {{ $post->meta_desc }}
@endsection

@section('meta_keys')
    {{ $post->meta_keys }}
@endsection

@section('meta_title')
    {{ $post->meta_title }}
@endsection


@section('content')

<div class="breadcrumb-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-inner">
            <h1 class="page-title">{{$post->title}}</h1>
            <ul class="page-list">
              <li class="active"><a href="{{route('home')}}">Home</a></li>
              <li>{{$post->title}}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>



   <!--====== Start Blog Standard Loop ======-->
   <section class="blog-area p-t-130 p-b-130">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Blog Content -->
                <div class="blog-details-content p-r-40 p-r-lg-0">
                    <div class="post-thumbnail">
                        <img src="{{filePath($post->image)}}"  width="730px" height="500px" alt="{{$post->title}}">
                    </div>

                    <div class="post-content">
                        <ul class="post-meta">
                            @if($post->author != null)
                            <li><a href="#" class="post-meta"><i class="far fa-user"></i>{{$post->author->name}}</a></li>
                            @endif
                            
                            <li><a href="#" class="post-meta"><i class="far fa-calendar-alt"></i>{{dateTimeFormat($post->created_at)}}</a> </li>

                            <li class="d-none"><a href="#" class="post-meta"><i class="far fa-comment-dots"></i>Comments (05)</a></li>
                        </ul>
                        <h3 class="post-title">
                            <a href="{{route('blog.post.details',$post->slug)}}">
                            {{$post->title}}
                            </a>
                        </h3>

                        <p>@pureme($post->desc)</p>
                    </div>
                    <div class="post-footer m-t-40">
                        <ul class="related-tags">
                            <li class="item-heading"> @translate(Related Tags): </li>
                            @if($post->tags != null)
                             @foreach(json_decode($post->tags) as $i)
                             <li><a href="#">{{$i}}</a></li>
                             @endforeach
                            @endif
                        </ul>
                        <ul class="social-links d-none">
                            <li class="item-heading">Share :</li>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                        </ul>

                        
                    </div>
                </div>
                
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar m-t-md-80">

                    @if ($categories->count() > 0)
                        <div class="widget category-widget">
                            <h4 class="widget-title">@translate(Category)</h4>

                            <ul class="category-link">
                                @foreach ($categories as $cat)
                                    <li><a href="{{route('category.post',$cat->slug)}}">{{$cat->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($popularPosts->count() > 0)
                        <div class="widget latest-post-widget">
                            <h4 class="widget-title">@translate(Latest artical)</h4>
                            <div class="popular-posts-wrapper">
                                @foreach ($popularPosts as $popular)
                                    <div class="popular-posts-item">
                                        <div class="popular-posts-thumbnail">
                                            <a href="{{route('blog.post.details',$popular->slug)}}">
                                                <img src="{{filePath($popular->image)}}"
                                                    alt="latest post one" width="70px" height="65px">
                                            </a>
                                        </div>
                                        <div class="popular-posts-item-content">
                                            <h5 class="popular-posts-title"><a href="{{route('blog.post.details',$popular->slug)}}">{{$popular->title}}</a></h5>
                                            <a href="#" class="posts-date"><i class="far fa-calendar-alt"></i> {{dateTimeFormat($popular->created_at)}}</a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Blog Standard Loop ======-->

@endsection

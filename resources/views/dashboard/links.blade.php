@extends('layouts.master')
@section('title')
    @translate(All links)
@endsection
@section('sub-title')
    <a class="nav=link" href="{{ route('dashboard') }}">
        @translate(Dashboard)
    </a>
@endsection
@section('main-content')
    <div class="contentbar">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@translate(Links)</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2">
                <!-- there are the main content-->

                <!-- Start Breadcrumbbar -->
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border-info m-b-30">
                            <div class="card-header">Home</div>
                            <div class="card-body text-info">
                                <h5 class="card-title text-info home">{{ route('home') }}</h5>
                                <a href="#" class="btn d-none" onclick="copyThe('home')">Copy</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border-info m-b-30">
                            <div class="card-header">Login</div>
                            <div class="card-body text-info">
                                <h5 class="card-title text-info login">{{ route('login') }}</h5>
                                <a href="#" class="btn d-none" onclick="copyThe('login')">Copy</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border-info m-b-30">
                            <div class="card-header">Registration</div>
                            <div class="card-body text-info">
                                <h5 class="card-title text-info register">{{ route('register') }}</h5>
                                <a href="#" class="btn d-none" onclick="copyThe('register')">Copy</a>
                            </div>
                        </div>
                    </div>


                    {{-- <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border-info m-b-30">
                            <div class="card-header">Contact page</div>
                            <div class="card-body text-info">
                                <h5 class="card-title text-info contact">{{ route('contact') }}</h5>
                                <a href="#" class="btn d-none" onclick="copyThe('contact')">Copy</a>
                            </div>
                        </div>
                    </div> --}}


                    {{-- <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border-info m-b-30">
                            <div class="card-header">Service page</div>
                            <div class="card-body text-info">
                                <h5 class="card-title text-info service">{{ route('service') }}</h5>
                                <a href="#" class="btn d-none" onclick="copyThe('service')">Copy</a>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border-info m-b-30">
                            <div class="card-header">Pricing Reset</div>
                            <div class="card-body text-info">
                                <h5 class="card-title text-info pricing">{{ route('pricing') }}</h5>
                                <a href="#" class="btn d-none" onclick="copyThe('pricing')">Copy</a>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border-info m-b-30">
                            <div class="card-header">Blog Posts</div>
                            <div class="card-body text-info">
                                <h5 class="card-title text-info blogPosts">{{ route('blog.posts') }}</h5>
                                <a href="#" class="btn d-none" onclick="copyThe('blogPosts')">Copy</a>
                            </div>
                        </div>
                    </div>


                    @foreach ($pages as $item)
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="card border-info m-b-30">
                                <div class="card-header"> <span class="badge badge-danger-inverse">Page </span> :
                                    {{ $item->title }} </div>
                                <div class="card-body text-info">
                                    <h5 class="card-title text-info page-{{ $item->id }}">
                                        {{ route('page', $item->slug) }}</h5>
                                    <a href="#" class="btn d-none"
                                        onclick="copyThe('page-{{ $item->id }}')">Copy</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- End Contentbar -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function copyThe(data) {
            debugger
            var copyText = $('.' + data);
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

        }
    </script>
@endsection

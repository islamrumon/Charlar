@section('title')
    {{ getSystemSetting('type_name') }}
@endsection
@extends('layouts.master')

@section('main-content')

    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">@translate(Google Analytics)</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">@translate(Home)</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('analytics.dashboard') }}">@translate(Google Analytics Dashboard)</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbbar -->
    <!-- Start Contentbar -->
    @isset($no_data)
    <div class="contentbar">
        <div class="alert alert-danger">
            <h2>Google analytics not setup properly,Please check</h2>
        </div>
    </div>
    @endisset

    @isset($visitor)
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-6 col-xl-6 col-md-6  col-sm-12">
                <div class="p-5 m-5 bg-white rounded shadow">
                    {!! $visitor->container() !!}
                </div>
            </div>
            <!-- End row -->

            <!-- Start col -->
            <div class="col-lg-6 col-xl-6 col-md-6  col-sm-12">
                <div class="p-5 m-5 bg-white rounded shadow">
                    {!! $topReffer->container() !!}
                </div>
            </div>
            <!-- End row -->

            <!-- Start col -->
            <div class="col-lg-6 col-xl-6 col-md-6  col-sm-12">
                <div class="p-5 m-5 bg-white rounded shadow">
                    {!! $topBrowsers->container() !!}
                </div>
            </div>
            <!-- End row -->


            <!-- Start col -->
            <div class="col-lg-12 col-xl-12 col-md-12  col-sm-12">
                <div class="p-5 m-5 bg-white rounded shadow">
                    {!! $totalVisitorAndPage->container() !!}
                </div>
            </div>
            <!-- End row -->


            <!-- Start col -->
            <div class="col-lg-12 col-xl-12 col-md-12  col-sm-12">
                <div class="p-5 m-5 bg-white rounded shadow">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@translate(Total Vistitor par page)</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <!-- there are the main content-->
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>@translate(S/L)</th>
                                        <th>@translate(date)</th>
                                        <th>@translate(visitors)</th>
                                        <th>@translate(pageViews)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fetchTotalVisitorsAndPageViews as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td>
                                                {{ $item['date']->isoFormat('dddd D M') }}
                                            </td>
                                            <td>
                                                <strong>{{ $item['visitors'] }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $item['pageViews'] }}</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End row -->

            <div class="col-lg-12 col-xl-12 col-md-12  col-sm-12">
                <div class="p-5 m-5 bg-white rounded shadow">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@translate(Most visited pages list)</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <!-- there are the main content-->
                            <table  class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>@translate(S/L)</th>
                                        <th>@translate(URL)</th>
                                        <th>@translate(pageTitle)</th>
                                        <th>@translate(pageViews)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fetchMostVisitedPages as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td>
                                                <strong>{{ $item['url'] }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $item['pageTitle'] }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $item['pageViews'] }}</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End col -->
    </div>
    @endisset

    <!-- End row -->

    </div>
    <!-- End Contentbar -->
@endsection
@isset($visitor)
@section('script')

    <script src="{{ $visitor->cdn() }}"></script>
    <script src="{{ $topReffer->cdn() }}"></script>
    <script src="{{ $topBrowsers->cdn() }}"></script>
    <script src="{{ $totalVisitorAndPage->cdn() }}"></script>


    {{ $visitor->script() }}
    {{ $totalVisitorAndPage->script() }}

    {{ $topBrowsers->script() }}
    {{ $topReffer->script() }}
@endsection
@endisset

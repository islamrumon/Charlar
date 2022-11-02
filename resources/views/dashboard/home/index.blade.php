@extends('layouts.master')
@section('title')
    @translate(Dashboard)
@endsection
@section('sub-title')
    @translate(Default)
@endsection
@section('main-content')
    <!-- Container-fluid starts-->
    <div class="container-fluid default-dash">
        <div class="row">
            <div class="col-xl-6 col-md-6 dash-xl-50">
                <div class="card profile-greeting">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <div class="greeting-user">
                                    <h1>Hello, {{ $user->name }}</h1>
                                    <p>Welcome back, your dashboard is ready!</p>
                                </div>
                            </div>
                        </div>
                        <div class="cartoon-img">
                            <img height="235px" src="{{ filePath('undraw_high_five_re_jy71.svg') }}"
                                alt="{{ getSystemSetting('type_name') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 dash-xl-50">
                <div class="card pb-0  earning-card">
                    <div class="card-header "></div>
                    <div class="card-body p-0">
                        <div class="earning-content">
                            <h4>Users</h4>
                            <div class="avatar mt-5">
                                <img class="img-100 rounded-circle"
                                    src="{{ asset('') }}/assets/images/avtar/avatar-1.jpg" alt="#">
                            </div>
                            <h6>{{ $users->count() }}</h6>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 dash-xl-50">
                <div class="card pb-0  earning-card">
                    <div class="card-header "></div>
                    <div class="card-body p-0">
                        <div class="earning-content">
                            <h4>Groups</h4>
                            <div class="customers d-inline-block avatar-group mt-5">
                                <ul>
                                    <li class="d-inline-block"><img class="img-100 rounded-circle"
                                            src="{{ asset('') }}/assets/images/avtar/avatar-4.jpg" alt=""></li>
                                    <li class="d-inline-block"><img class="img-100 rounded-circle"
                                            src="{{ asset('') }}/assets/images/avtar/avatar-5.jpg" alt=""></li>
                                    <li class="d-inline-block"><img class="img-100 rounded-circle"
                                            src="{{ asset('') }}/assets/images/avtar/avatar-1.jpg" alt=""></li>
                                </ul>
                            </div>
                            <h6>{{ $groups->count() }}</h6>

                        </div>
                    </div>
                </div>
            </div>
          
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6  dash-xl-50">
                <div class="card news-update">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h5 class="m-0">New  Users</h5>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordernone">
                                <tbody>
                                    @foreach ($users->latest()->paginate(10) as $item)
                                        <tr>
                                            <td>
                                                <div class="media"><img class="img-fluid me-3 b-r-5"
                                                        src="{{ filePath($item->avatar) }}" width="38px" height="38px"
                                                        alt="{{ $item->slug }}">
                                                    <div class="media-body"><a href="#">
                                                            <h5>{{ $item->name }}</h5>
                                                        </a>
                                                        <p>{{ $item->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span
                                                    class="badge badge-light-theme-light font-theme-light">{{ timeForHumans($item->created_at) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6  dash-xl-50">
                <div class="card news-update">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h5 class="m-0">New Groups</h5>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordernone">
                                <tbody>
                                    @foreach ($groups->latest()->paginate(10) as $group)
                                        <tr>
                                            <td>
                                                <div class="media"><img class="img-fluid me-3 b-r-5"
                                                        src="{{ filePath($group->avatar) }}" width="38px" height="38px"
                                                        alt="{{ $group->slug }}">
                                                    <div class="media-body"><a href="#">
                                                            <h5>{{ $group->name }}</h5>
                                                        </a>
                                                        @if($group->admin != null)
                                                         <p>Creator: <span class="font-theme-light">{{ $group->admin->name }}</span></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span
                                                    class="badge badge-light-theme-light font-theme-light">{{ timeForHumans($item->created_at) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection

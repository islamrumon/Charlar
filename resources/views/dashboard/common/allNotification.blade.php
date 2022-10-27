@extends('layouts.master')
@section('title')
    @translate(All)
@endsection

@section('sub-title')
    <a href="{{ route('all.notifications') }}">
        @translate(notifications)
    </a>
@endsection
@section('main-content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="card recent-activity">
            <div class="card-header card-no-border">
                <div class="media media-dashboard">
                    <div class="media-body">
                        <h5 class="mb-0">@translate(Notifications)</h5>
                    </div>
                    <div class="icon-box onhover-dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                        <div class="icon-box-show onhover-show-div">
                            <ul>
                                <li> <a href="{{ route('all.read') }}">
                                        @translate(All Read) </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordernone">
                        <tbody>
                            @foreach ($notifications as $item)
                                <tr>
                                    <td>
                                        @if ($item->read_at == null)
                                            <div class="alert alert-light" role="alert">
                                            @else
                                                <div class="media">
                                        @endif

                                        <div class="media-body"><a href="{{ $item->data['link'] }}">
                                                <h5>{{ $item->data['subject'] }}</h5>
                                                <p>{{ $item->data['title'] }}</p>
                                            </a>
                                            <p class="activity-msg"> <span
                                                    class="activity-msg-box">{{ $item->data['body'] }}</span></p>
                                        </div>
                </div>
                </td>
                <td><span
                        class="badge badge-light-theme-light font-theme-light">{{ dateTimeFormat($item->created_at) }}</span>
                </td>
                </tr>
                @endforeach


                </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection

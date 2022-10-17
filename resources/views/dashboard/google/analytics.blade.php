@extends('layouts.master')
@section('title') @translate(Google analytics CMS Setup) @endsection
@section('main-content')
    <div class="card ">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Google analytics setup)</h2>
            </div>
            <div class="float-right">

            </div>
        </div>

        <div class="card-body">
            <form action="{{route('google.analytics.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <strong>For get right data setup google analytics  properly</strong>

                <div class="form-group">
                    <label>@translate(Google Analytics Active) <span class="text-danger">*</span></label>
                    <select class="form-control select" name="google_analytics_active">
                        <option value="No"  {{ getSystemSetting('google_analytics_active') == 'No' ? 'selected' : null }}>No</option>
                        <option value="Yes" {{ getSystemSetting('google_analytics_active') == 'Yes' ? 'selected' : null }}>Yes</option>
                    </select>
                </div>


                <div class="form-group">
                    <label>@translate(View Id) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('ANALYTICS_VIEW_ID') }}" type="text"  name="ANALYTICS_VIEW_ID" required>
                </div>

                <div class="form-group">
                    <label>@translate(Gtag Id) <span class="text-danger">*</span></label>
                    <input class="form-control" value="{{ env('ANALYTICS_GTAG_ID') }}" type="text"  name="ANALYTICS_GTAG_ID" required>
                </div>


                <div class="form-group">
                    <label>@translate(Upload client secret json )</label>
                    <input class="form-control-file"  type="file"  name="credentials_json" >
                </div>

                <a href="{{ asset('google_analytics.json') }}" class="nav-link">json link</a>


                <div class="form-group">
                    <label>@translate(Domain verify file )</label>
                    <input class="form-control-file"  type="file"  name="domain_verify" >
                </div>



                <div class="float-right">
                    <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
                </div>

            </form>
        </div>
    </div>
@endsection



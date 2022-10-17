@extends('layouts.master')
@section('title')
    @translate(Setting)
@endsection


@section('sub-title')
    <a class="nav=link" href="{{ route('dashboard') }}">
        @translate(Dashboard)
    </a>
@endsection

@section('main-content')
    <div class="container-fluid">

        <div class="card ">
            <div class="card-header">
                <h2 class="card-title">@translate(CMS Seo Setup)</h2>
            </div>
            <div class="card-body g-3">
                <form method="post" action="{{ route('seo.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <!--name-->
                            <label class="form-label">@translate(Meta keys)</label>
                            <textarea class="form-control" name="meta_keys"> {!! getSystemSetting('meta_keys') !!}</textarea>


                            <!--name-->
                            <label class="form-label">@translate(Meta Title )</label>
                            <textarea class="form-control" name="meta_title">{!! getSystemSetting('meta_title') !!}</textarea>

                            <!--name-->
                            <label class="form-label">@translate(Meta Descriptions)</label>
                            <textarea class="form-control" name="meta_desc">{!! getSystemSetting('meta_desc') !!}</textarea>


                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <button class="btn btn-block btn-primary" type="submit">@translate(Save)</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')
@section('title')
@translate(CMS Seo Setup)
@endsection


@section('sub-title')
    <a class="nav=link" href="{{ route('dashboard') }}">
        @translate(Dashboard)
    </a>
@endsection

@section('main-content')
    <div class="container-fluid">

        <div class="card ">
            
            <div class="card-body g-3">
                <form method="post" action="{{ route('seo.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <!--name-->
                            <label class="form-label">@translate(Meta keys)</label>
                            <textarea class="form-control"  name="meta_keys"> @pureme(getSystemSetting('meta_keys'))</textarea>


                            <!--name-->
                            <label class="form-label">@translate(Meta Title )</label>
                            <textarea class="form-control" name="meta_title"> @pureme(getSystemSetting('meta_title'))</textarea>

                            <!--name-->
                            <label class="form-label">@translate(Meta Descriptions)</label>
                            <textarea class="form-control" name="meta_desc">@pureme(getSystemSetting('meta_desc'))</textarea>


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

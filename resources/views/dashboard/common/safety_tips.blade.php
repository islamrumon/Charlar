@extends('layouts.master')
@section('title') @translate(Safety tips) @endsection
@section('main-content')
    <div class="contentbar">

        <div class="card m-2">
            <div class="card-header">
                <h2 class="card-title">@translate(Safety tips))</h2>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('tips.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <!--name-->
                            <label class="label">@translate(Tips_1)</label>
                            <input class="form-control" name="tips_1" value="{{ getSystemSetting('tips_1') }}">
                            
                            <label class="label">@translate(Tips_2)</label>
                            <input class="form-control" name="tips_2" value="{{ getSystemSetting('tips_2') }}">

                            <label class="label">@translate(Tips_3)</label>
                            <input class="form-control" name="tips_3" value="{{ getSystemSetting('tips_3') }}">

                            <label class="label">@translate(Tips_4)</label>
                            <input class="form-control" name="tips_4" value="{{ getSystemSetting('tips_4') }}">

                            <label class="label">@translate(Tips_5)</label>
                            <input class="form-control" name="tips_5" value="{{ getSystemSetting('tips_5') }}">

                            <label class="label">@translate(Tips_6)</label>
                            <input class="form-control" name="tips_6" value="{{ getSystemSetting('tips_6') }}">

                            
                        </div>
                    </div>
                    <hr>
                    <div class="m-2 text-center">
                        <button class="btn btn-block btn-primary" type="submit">@translate(Save)</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



@endsection

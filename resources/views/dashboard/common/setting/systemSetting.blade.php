@extends('layouts.master')
@section('title')
    @translate(System Setting)
@endsection
@section('sub-title')
    @translate(Setup)
@endsection
@section('main-content')
    <div class="container-fluid">

        <div class="card">
        
            <div class="card-body">
                <form method="post" action="{{ route('system.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Google Translate </h2>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select class="form-select" name="multi_lang" id="floatingSelect" aria-label="Floating label select example">
                                              <option value="Yes" {{getSystemSetting('multi_lang') == "Yes" ? 'selected' : null}}>On</option>
                                              <option value="No" {{getSystemSetting('multi_lang') == "No" ? 'selected' : null}}>Off</option>
                                            </select>
                                            <label for="floatingSelect">@translate(Google translate active)</label>
                                          </div>
                                        <label></label>
                                        
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Calling Features </h2>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select class="form-select" name="voice_call" id="floatingSelect" aria-label="Floating label select example">
                                              <option value="Yes" {{getSystemSetting('voice_call') == "Yes" ? 'selected' : null}}>On</option>
                                              <option value="No" {{getSystemSetting('voice_call') == "No" ? 'selected' : null}}>Off</option>
                                            </select>
                                            <label for="floatingSelect">@translate(Voice Calling active)</label>
                                          </div>
                                        <label></label>
                                        
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select class="form-select" name="video_call" id="floatingSelect" aria-label="Floating label select example">
                                              <option value="Yes" {{getSystemSetting('video_call') == "Yes" ? 'selected' : null}}>On</option>
                                              <option value="No" {{getSystemSetting('video_call') == "No" ? 'selected' : null}}>Off</option>
                                            </select>
                                            <label for="floatingSelect">@translate(Video Calling active)</label>
                                          </div>
                                        <label></label>
                                        
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

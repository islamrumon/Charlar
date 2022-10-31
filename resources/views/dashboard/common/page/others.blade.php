@extends('layouts.master')
@section('title')
    @translate(Others Static content)
@endsection
@section('sub-title')
    @translate(Setup)
@endsection
@section('main-content')
    <div class="container-fluid">

        <div class="card">
        
            <div class="card-body">
                <form method="post" action="{{ route('other.page.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Home First section</h2>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label>@translate(First Section title)</label>
                                        <input type="text" value="{{ getSystemSetting('slider_title') }}" name="slider_title"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>@translate(First Section button name)</label>
                                        <input class="form-control" name="slider_btn" value="{{getSystemSetting('slider_btn')}}">
        
                                    </div>
                                    <div class="mb-3">
                                        <label>@translate(First Section Sub title)</label>
                                        <textarea class="form-control" name="slider_sub_title">@pureme(getSystemSetting('slider_sub_title'))</textarea>
                                    </div>
        
                                
                                    <img src="{{filePath(getSystemSetting('slider_right_image'))}}" width="847px" height="478px" class="img-fluid">
                                    <div class="mb-3">
                                        <label>@translate(First Section image)</label>
                                        <input type="file" class="form-control" name="slider_right_image">
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
                                    <h2 class="card-title">Home Secound section</h2>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label>@translate(Secound Section title)</label>
                                        <input type="text" value="{{ getSystemSetting('about_1_title') }}" name="about_1_title"
                                            class="form-control">
                                    </div>
                                
                                    <div class="mb-3">
                                        <label>@translate(Secound Section Sub title)</label>
                                        <textarea class="form-control" name="about_1_sub_title">@pureme(getSystemSetting('about_1_sub_title'))</textarea>
                                    </div>
        
                                
                                    <img src="{{filePath(getSystemSetting('about_1_image'))}}" width="847px" height="478px" class="img-fluid">
                                    <div class="mb-3">
                                        <label>@translate(Secound Section image)</label>
                                        <input type="file" class="form-control" name="about_1_image">
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
                                    <h2 class="card-title">Home 3rd section</h2>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label>@translate(3rd Section title)</label>
                                        <input type="text" value="{{ getSystemSetting('about_2_title') }}" name="about_2_title"
                                            class="form-control">
                                    </div>
                                
                                    <div class="mb-3">
                                        <label>@translate(3rd Section Sub title)</label>
                                        <textarea class="form-control" name="about_2_sub_title">@pureme(getSystemSetting('about_2_sub_title'))</textarea>
                                    </div>
        
                                
                                    <img src="{{filePath(getSystemSetting('about_2_image'))}}" width="847px" height="478px" class="img-fluid">
                                    <div class="mb-3">
                                        <label>@translate(3rd Section image)</label>
                                        <input type="file" class="form-control" name="about_2_image">
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
                                    <h2 class="card-title">Home Contact section</h2>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label>@translate(Contact Section text)</label>
                                        <textarea class="form-control" name="contact_sub_title">@pureme(getSystemSetting('contact_sub_title'))</textarea>
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

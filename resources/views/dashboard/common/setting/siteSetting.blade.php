@extends('layouts.master')
@section('title')
    @translate(CMS Setting Setup)s
@endsection
@section('sub-title')
    @translate(Setup)
@endsection

@section('main-content')
    <div class="container-fluid">

        <div class="card">

            <div class="card-body">
                <form method="post" action="{{ route('site.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <!--logo-->
                            <label>@translate(CMS logo)</label>

                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="type_logo" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview"
                                        style="background-image: url({{ filePath(getSystemSetting('type_logo')) }});">
                                    </div>
                                </div>
                            </div>
                            <!--logo end-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <!--footer logo-->
                            <label>@translate(Footer Logo)</label>

                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="footer_logo" id="imageUpload_f_logo"
                                        accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload_f_logo"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview_f_logo"
                                        style="background-image: url({{ filePath(getSystemSetting('footer_logo')) }});">
                                    </div>
                                </div>
                            </div>
                            <!--footer logo end-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <!--favicon icon-->
                            <label>@translate(Favicon Icon)</label>



                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="favicon_icon" id="imageUpload_f_icon"
                                        accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload_f_icon"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview_f_icon"
                                        style="background-image: url({{ filePath(getSystemSetting('favicon_icon')) }}">
                                    </div>
                                </div>
                            </div>
                            <!--favicon end-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!--name-->
                            <div class="mb-3">
                                <label class="text-bold">@translate(CMS Name)</label>
                                <input type="text" value="{{ getSystemSetting('type_name') }}" name="type_name"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <!--footer-->
                                <label class="font-weight-bold">@translate(CMS Footer Copyright )</label>
                                <input type="text" value="{{ getSystemSetting('type_footer') }}" name="type_footer"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <!--address-->
                                <label>@translate(Address)</label>

                                <input type="text" value="{{ getSystemSetting('type_address') }}" name="type_address"
                                    class="form-control">
                            </div>

                            <div class="mb-3">
                                <!--mail-->
                                <label>@translate(CMS Mail)</label>

                                <input type="text" value="{{ getSystemSetting('type_mail') }}" name="type_mail"
                                    class="form-control">
                            </div>
                            <div class="mb-3 d-none">
                                <label>@translate(CMS pinterest Link)</label>
                                <input type="text" value="{{ getSystemSetting('type_pinterest') }}" name="type_pinterest"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>@translate(CMS instagram Link)</label>
                                <input type="text" value="{{ getSystemSetting('type_instagram') }}" name="type_instagram"
                                    class="form-control">
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <!--fb-->
                                <label>@translate(CMS Facebook Link)</label>

                                <input type="text" value="{{ getSystemSetting('type_fb') }}" name="type_fb"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <!--tw-->
                                <label>@translate(CMS Twitter Link)</label>
                                <input type="text" value="{{ getSystemSetting('type_tw') }}" name="type_tw"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <!--google-->
                                <label>@translate(CMS Google Link)</label>

                                <input type="text" value="{{ getSystemSetting('type_google') }}" name="type_google"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>@translate(CMS linkedin Link)</label>
                                <input type="text" value="{{ getSystemSetting('type_linkedin') }}" name="type_linkedin"
                                    class="form-control">

                            </div>



                            <div class="mb-3">
                                <!--Number-->
                                <label>@translate(CMS Number )</label>

                                <input type="text" value="{{ getSystemSetting('type_number') }}" name="type_number"
                                    class="form-control">
                            </div>

                        </div>
                    </div>






                    <div class="m-2">
                        <button class="btn btn-block btn-primary" type="submit">@translate(Save)</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

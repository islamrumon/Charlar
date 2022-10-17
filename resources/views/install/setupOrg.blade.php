@extends('install.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('org.setup')}}" enctype="multipart/form-data" class="text-left">
                @csrf

                <div class="form-head text-lg-center ">
                    <img src="{{asset(getSystemSetting('type_logo'))}}" class="img-fluid" alt="logo">
                </div>
                <h4 class="text-lg-center  ont-weight-bold p-3">@translate(Setup CMS Setting)</h4>
                <div class="row">
                    <div class="col-4">
                        <!--logo-->
                        <label class="label">@translate(CMS logo)</label>
                        <input type="hidden" value="type_logo" name="type_logo">

                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' name="logo" id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview"
                                     style="background-image: url({{filePath(getSystemSetting('type_logo'))}});">
                                </div>
                            </div>
                        </div>
                        <!--logo end-->
                    </div>
                    <div class="col-4">
                        <!--footer logo-->
                        <label class="label">@translate(CMS Footer Logo)</label>
                        <input type="hidden" value="footer_logo" name="footer_logo">

                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' name="f_logo" id="imageUpload_f_logo" accept=".png, .jpg, .jpeg"/>
                                <label for="imageUpload_f_logo"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview_f_logo"
                                     style="background-image: url({{filePath(getSystemSetting('footer_logo'))}});">
                                </div>
                            </div>
                        </div>
                        <!--footer logo end-->
                    </div>
                    <div class="col-4">
                        <!--favicon icon-->
                        <label class="label">@translate(CMS favicon Icon)</label>
                        <input type="hidden" value="favicon_icon" name="favicon_icon">


                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' name="f_icon" id="imageUpload_f_icon" accept=".png, .jpg, .jpeg"/>
                                <label for="imageUpload_f_icon"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview_f_icon"
                                     style="background-image: url({{filePath(getSystemSetting('favicon_icon'))}}">
                                </div>
                            </div>
                        </div>
                        <!--favicon end-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <!--name-->
                        <label class="label">@translate(CMS Name)</label>
                        <input type="hidden" value="type_name" name="type_name">
                        <input type="text"  value="{{ getSystemSetting('type_name') }}" name="name"
                               class="form-control">

                        <!--footer-->
                        <label class="label">@translate(CMS Footer)</label>
                        <input type="hidden" value="type_footer" name="type_footer">
                        <input type="text"  value="{{ getSystemSetting('type_footer') }}" name="footer"
                               class="form-control">

                        <!--address-->
                        <label class="label">@translate(CMS Address)</label>
                        <input type="hidden" value="type_address" name="type_address">
                        <input type="text" value="{{ getSystemSetting('type_address') }}" name="address"
                               class="form-control">

                        <!--mail-->
                        <label class="label">@translate(CMS Mail)</label>
                        <input type="hidden" value="type_mail" name="type_mail">
                        <input type="text" value="{{ getSystemSetting('type_mail') }}" name="mail"
                               class="form-control">
                    </div>
                    <div class="col-6">
                        <!--fb-->
                        <label class="label">@translate(CMS Facebook Link)</label>
                        <input type="hidden" value="type_fb" name="type_fb">
                        <input type="text" value="{{ getSystemSetting('type_fb') }}" name="fb"
                               class="form-control">

                        <!--tw-->
                        <label class="label">@translate(CMS Twitter Link)</label>
                        <input type="hidden" value="type_tw" name="type_tw">
                        <input type="text" value="{{ getSystemSetting('type_tw') }}" name="tw"
                               class="form-control">

                        <!--google-->
                        <label class="label">@translate(CMS Google Link)</label>
                        <input type="hidden" value="type_google" name="type_google">
                        <input type="text" value="{{ getSystemSetting('type_google') }}" name="google"
                               class="form-control">

                        <!--Number-->
                        <label class="label">@translate(CMS Number )</label>
                        <input type="hidden" value="type_number" name="type_number">
                        <input type="text" value="{{ getSystemSetting('type_number') }}" name="number"
                               class="form-control">
                    </div>
                </div>





                <div class="m-2">
                    <button class="btn btn-primary btn-lg btn-block font-18" type="submit">@translate(Save)</button>
                </div>
            </form>

        </div>
    </div>



@endsection

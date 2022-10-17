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
            <div class="card-header">
                <h2 class="card-title">@translate(System Setting)</h2>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('system.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">


                            <label class="label">@translate(Slider Section Title)</label>
                            <input type="text" value="{{ getSystemSetting('slider_title') }}" name="slider_title"
                                class="form-control">

                            <label class="label">@translate(Slider Section Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('slider_sub_title') }}" name="slider_sub_title"
                                class="form-control">

                            <label class="label">@translate(Featured Title)</label>
                            <input type="text" value="{{ getSystemSetting('featured_title') }}" name="featured_title"
                                class="form-control">

                            <label class="label">@translate(Featured Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('featured_sub_title') }}"
                                name="featured_sub_title" class="form-control">

                            <label class="label">@translate(Recommend Title)</label>
                            <input type="text" value="{{ getSystemSetting('recommend_title') }}" name="recommend_title"
                                class="form-control">


                            <label class="label">@translate(Recommend Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('recommend_sub_title') }}"
                                name="recommend_sub_title" class="form-control">


                            <label class="label">@translate(Trending Title)</label>
                            <input type="text" value="{{ getSystemSetting('trending_title') }}" name="trending_title"
                                class="form-control">

                            <label class="label">@translate(Trending Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('trending_sub_title') }}"
                                name="trending_sub_title" class="form-control">

                            <label class="label">@translate(Top Title)</label>
                            <input type="text" value="{{ getSystemSetting('top_title') }}" name="top_title"
                                class="form-control">

                            <label class="label">@translate(Top Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('top_sub_title') }}" name="top_sub_title"
                                class="form-control">

                            <label class="label">@translate(City Title)</label>
                            <input type="text" value="{{ getSystemSetting('city_title') }}" name="city_title"
                                class="form-control">

                            <label class="label">@translate(City Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('city_sub_title') }}" name="city_sub_title"
                                class="form-control">


                            <label class="label">@translate(Category Title)</label>
                            <input type="text" value="{{ getSystemSetting('category_title') }}" name="category_title"
                                class="form-control">

                            <label class="label">@translate(Category Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('category_sub_title') }}"
                                name="category_sub_title" class="form-control">


                            <label class="label">@translate(State Title)</label>
                            <input type="text" value="{{ getSystemSetting('state_title') }}" name="state_title"
                                class="form-control">

                            <label class="label">@translate(State Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('state_sub_title') }}" name="state_sub_title"
                                class="form-control">

                            <label class="label">@translate(Advertise Title)</label>
                            <input type="text" value="{{ getSystemSetting('advertise_title') }}" name="advertise_title"
                                class="form-control">

                            <label class="label">@translate(Advertise Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('advertise_sub_title') }}"
                                name="advertise_sub_title" class="form-control">


                            <label class="label">@translate(Plane Title)</label>
                            <input type="text" value="{{ getSystemSetting('plane_title_2') }}" name="plane_title_2"
                                class="form-control">

                            <label class="label">@translate(Plane Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('plane_sub_title') }}"
                                name="plane_sub_title" class="form-control">

                            <label class="label">@translate(Add Page Title)</label>
                            <input type="text" value="{{ getSystemSetting('ads_page_title') }}" name="ads_page_title"
                                class="form-control">

                            <label class="label">@translate(Ads Page Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('ads_page_sub_title') }}"
                                name="ads_page_sub_title" class="form-control">


                            <label class="label">@translate(Subscribe Section Title)</label>
                            <input type="text" value="{{ getSystemSetting('subscribe_title') }}"
                                name="subscribe_title" class="form-control">

                            <label class="label">@translate(Subscribe Section Sub Title)</label>
                            <input type="text" value="{{ getSystemSetting('subscribe_sub_title') }}"
                                name="subscribe_sub_title" class="form-control">



                            <label class="label">@translate(Footer Location Text)</label>
                            <input type="text" value="{{ getSystemSetting('footer_location') }}"
                                name="footer_location" class="form-control">

                            <label class="label">@translate(Footer number)</label>
                            <input type="text" value="{{ getSystemSetting('footer_number') }}" name="footer_number"
                                class="form-control">

                            <label class="label">@translate(Footer mail address)</label>
                            <input type="text" value="{{ getSystemSetting('footer_mail') }}" name="footer_mail"
                                class="form-control">
                            <hr>

                            <label class="label">@translate(Login Register page Text 1)</label>
                            <input type="text" value="{{ getSystemSetting('login_ad_line_1') }}"
                                name="login_ad_line_1" class="form-control">

                            <label class="label">@translate(Login Register page Text 2)</label>
                            <input type="text" value="{{ getSystemSetting('login_ad_line_2') }}"
                                name="login_ad_line_2" class="form-control">

                            <label class="label">@translate(Login Register page Text 3)</label>
                            <input type="text" value="{{ getSystemSetting('login_ad_line_3') }}"
                                name="login_ad_line_3" class="form-control">


                            <label class="label">@translate(Related page Text )</label>
                            <input type="text" value="{{ getSystemSetting('related_ads_text') }}"
                                name="related_ads_text" class="form-control">




                            <label class="label">@translate(Blog title)</label>
                            <input type="text" value="{{ getSystemSetting('blog_title_2') }}" name="blog_title_2"
                                class="form-control">

                            <label class="label">@translate(Blog subtitle)</label>
                            <input type="text" value="{{ getSystemSetting('blog_subtitle') }}" name="blog_subtitle"
                                class="form-control">

                            <label class="label">@translate(Blog posts list title)</label>
                            <input type="text" value="{{ getSystemSetting('blog_list') }}" name="blog_list"
                                class="form-control">

                            <label class="label">@translate(Memebr Dashboard Text)</label>
                            <input type="text" value="{{ getSystemSetting('dashboard_text') }}" name="dashboard_text"
                                class="form-control">


                            <hr>
                            <strong>Settings </strong>

                            <label class="label">@translate(Ads Paginate count)</label>
                            <input type="number" value="{{ getSystemSetting('paginate') }}" name="paginate"
                                class="form-control">

                            <label class="label">@translate(News letter active)</label>
                            <select name="newsletter" class="select form-control">
                                <option value="off" {{ getSystemSetting('newsletter') == 'off' ? 'selected' : null }}>
                                    OFF
                                </option>
                                <option value="on" {{ getSystemSetting('newsletter') == 'on' ? 'selected' : null }}>ON
                                </option>
                            </select>


                            <label class="label">@translate(Ads Paginate count)</label>
                            <input type="text" value="{{ getSystemSetting('paginate') }}" name="paginate"
                                class="form-control">

                            <label class="label">@translate(Blog Module Active)</label>
                            <select name="blog_module_active" class="select form-control">
                                <option value="Yes"
                                    {{ getSystemSetting('blog_module_active') == 'Yes' ? 'selected' : null }}>On
                                </option>
                                <option value="No"
                                    {{ getSystemSetting('blog_module_active') == 'No' ? 'selected' : null }}>Off
                                </option>
                            </select>


                            <label class="label">@translate(Multi languages active)</label>
                            <select name="multi_lang" class="select form-control">
                                <option value="Yes" {{ getSystemSetting('multi_lang') == 'Yes' ? 'selected' : null }}>
                                    On
                                </option>
                                <option value="No" {{ getSystemSetting('multi_lang') == 'No' ? 'selected' : null }}>
                                    Off
                                </option>
                            </select>

                            <label class="label">@translate(Multi Currency active)</label>
                            <select name="multi_currency" class="select form-control">
                                <option value="Yes"
                                    {{ getSystemSetting('multi_currency') == 'Yes' ? 'selected' : null }}>On
                                </option>
                                <option value="No"
                                    {{ getSystemSetting('multi_currency') == 'No' ? 'selected' : null }}>
                                    Off
                                </option>
                            </select>

                        </div>
                        <div class="col-md-6">


                            <label class="label">@translate(Ads Page image)</label>
                            <input type="file" value="{{ getSystemSetting('ads_page_image') }}" name="ads_page_image"
                                class="form-control-file">

                            <div class="card m-3 p-3">
                                <img class="img-thumbnail" width="180px" height="100px"
                                    src="{{ filePath(getSystemSetting('ads_page_image')) }}">
                            </div>

                            <label class="label">@translate(Ad Details image)</label>
                            <input type="file" value="{{ getSystemSetting('ad_details_image') }}"
                                name="ad_details_image" class="form-control-file">

                            <div class="card m-3 p-3">
                                <img class="img-thumbnail" width="180px" height="100px"
                                    src="{{ filePath(getSystemSetting('ad_details_image')) }}">
                            </div>



                            <label class="label">@translate(Member Dashboard image)</label>
                            <input type="file" value="{{ getSystemSetting('dashboard_image') }}"
                                name="dashboard_image" class="form-control-file">

                            <div class="card m-3 p-3">
                                <img class="img-thumbnail" width="180px" height="100px"
                                    src="{{ filePath(getSystemSetting('dashboard_image')) }}">
                            </div>

                            <label class="label">@translate(State Page image)</label>
                            <input type="file" value="{{ getSystemSetting('state_image') }}" name="state_image"
                                class="form-control-file">

                            <div class="card m-3 p-3">
                                <img class="img-thumbnail" width="180px" height="100px"
                                    src="{{ filePath(getSystemSetting('state_image')) }}">
                            </div>

                            <label class="label">@translate(Category Page image)</label>
                            <input type="file" value="{{ getSystemSetting('category_image') }}" name="category_image"
                                class="form-control-file">
                            <div class="card m-3 p-3">
                                <img class="img-thumbnail" width="180px" height="100px"
                                    src="{{ filePath(getSystemSetting('category_image')) }}">
                            </div>

                            <label class="label">@translate(BLog page image)</label>
                            <input type="file" value="{{ getSystemSetting('posts_image') }}" name="posts_image"
                                class="form-control-file">
                            <div class="card m-3 p-3">
                                <img class="img-thumbnail" width="180px" height="100px"
                                    src="{{ filePath(getSystemSetting('posts_image')) }}">
                            </div>

                            <label class="label">@translate(Post Details page image)</label>
                            <input type="file" value="{{ getSystemSetting('post_details') }}" name="post_details"
                                class="form-control-file">
                            <div class="card m-3 p-3">
                                <img class="img-thumbnail" width="180px" height="100px"
                                    src="{{ filePath(getSystemSetting('post_details')) }}">
                            </div>
                            <label class="label">@translate(Login Register page Image)</label>
                            <input type="file" value="{{ getSystemSetting('login_banner') }}" name="login_banner"
                                class="form-control-file">
                            <div class="card m-3 p-3">
                                <img class="img-thumbnail" width="180px" height="100px"
                                    src="{{ filePath(getSystemSetting('login_banner')) }}">
                            </div>
                            <label class="label">@translate(Payment image)</label>

                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="payment_image" id="imageUpload_f_icon"
                                        accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload_f_icon"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview_f_icon"
                                        style="background-image: url('{{ filePath(getSystemSetting('payment_image')) }}')">
                                    </div>
                                </div>
                            </div>


                            <label class="label">@translate(Apps store play store image)</label>

                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="app_image" id="imageUpload_f_logo"
                                        accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload_f_logo"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview_f_logo"
                                        style="background-image: url('{{ filePath(getSystemSetting('app_image')) }}');">
                                    </div>
                                </div>
                            </div>


                            <label class="label">@translate(Pre loader)</label>

                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="pre_loader" id="imageUpload"
                                        accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imageUpload"
                                        style="background-image: url('{{ filePath(getSystemSetting('pre_loader')) }}');">
                                    </div>
                                </div>
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

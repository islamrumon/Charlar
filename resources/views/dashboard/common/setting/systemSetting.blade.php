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

                            <div class="mb-3">
                                <label>@translate(Header Title)</label>
                                <input type="text" value="{{ getSystemSetting('cms_title') }}" name="cms_title"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>@translate(Contact Location)</label>
                                <textarea class="form-control" name="footer_location">@pureme(getSystemSetting('footer_location'))</textarea>

                            </div>
                            <div class="mb-3">
                                <label>@translate(Contact Mails)</label>
                                <textarea class="form-control" name="footer_mail">@pureme(getSystemSetting('footer_mail'))</textarea>
                            </div>
                            <div class="mb-3">
                                <label>@translate(Contact Numbers)</label>
                                <textarea class="form-control" name="footer_number">@pureme(getSystemSetting('footer_number'))</textarea>
                            </div>

                            <div class="mb-3">
                                <label>@translate(Footer Text)</label>
                                <textarea class="form-control" name="footer_desc">@pureme(getSystemSetting('footer_desc'))</textarea>
                            </div>


                            <div class="mb-3">
                                <label>@translate(System Paginate count)</label>
                                <input type="number" value="{{ getSystemSetting('paginate') }}" name="paginate"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>@translate(Newsletter active)</label>
                                <select name="newsletter" class="select form-control">
                                    <option value="off"
                                        {{ getSystemSetting('newsletter') == 'off' ? 'selected' : null }}>
                                        OFF
                                    </option>
                                    <option value="on" {{ getSystemSetting('newsletter') == 'on' ? 'selected' : null }}>
                                        ON
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>@translate(Multi languages active)</label>
                                <select name="multi_lang" class="select form-control">
                                    <option value="Yes"
                                        {{ getSystemSetting('multi_lang') == 'Yes' ? 'selected' : null }}>
                                        On
                                    </option>
                                    <option value="No"
                                        {{ getSystemSetting('multi_lang') == 'No' ? 'selected' : null }}>
                                        Off
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>@translate(Multi Currency active)</label>
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
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>@translate(Pre loader)</label>
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

                            <div class="mb-3">
                                <label>@translate(Login Page image)</label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' name="login_image" id="imageUpload"
                                            accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imageUpload"
                                            style="background-image: url('{{ filePath(getSystemSetting('login_image')) }}');">
                                        </div>
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

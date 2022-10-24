<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/font-awesome.css">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesgeet"
        href="https://rawgit.com/creativetimofficial/material-kit/master/assets/css/material-kit.css">
    <style>
        html * {
            -webkit-font-smoothing: antialiased;
        }

        .h6,
        h6 {
            font-size: .75rem !important;
            font-weight: 500;
            font-family: Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.5em;
            text-transform: uppercase;
        }

        .name h6 {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .navbar {
            border: 0;
            border-radius: 3px;
            padding: .625rem 0;
            margin-bottom: 20px;
            color: #555;
            background-color: #fff !important;
            box-shadow: 0 4px 18px 0 rgba(0, 0, 0, .12), 0 7px 10px -5px rgba(0, 0, 0, .15) !important;
            z-index: 1000 !important;
            transition: all 150ms ease 0s;

        }

        .navbar.navbar-transparent {
            z-index: 1030;
            background-color: transparent !important;
            box-shadow: none !important;
            padding-top: 25px;
            color: #fff;
        }

        .navbar .navbar-brand {
            position: relative;
            color: inherit;
            height: 50px;
            font-size: 1.125rem;
            line-height: 30px;
            padding: .625rem 0;
            font-weight: 300;
            -webkit-font-smoothing: antialiased;
        }

        .navbar .navbar-nav .nav-item .nav-link:not(.btn) .material-icons {
            margin-top: -7px;
            top: 3px;
            position: relative;
            margin-right: 3px;
        }

        .navbar .navbar-nav .nav-item .nav-link .material-icons {
            font-size: 1.25rem;
            max-width: 24px;
            margin-top: -1.1em;
        }

        .navbar .navbar-nav .nav-item .nav-link .fa,
        .navbar .navbar-nav .nav-item .nav-link .material-icons {
            font-size: 1.25rem;
            max-width: 24px;
            margin-top: 0px;
        }

        .navbar .navbar-nav .nav-item .nav-link {
            position: relative;
            color: inherit;
            padding: .9375rem;
            font-weight: 400;
            font-size: 12px;
            border-radius: 3px;
            line-height: 20px;
        }

        a .material-icons {
            vertical-align: middle;
        }

        .fixed-top {
            position: fixed;
            z-index: 1030;
            left: 0;
            right: 0;
        }

        .profile-page .page-header {
            height: 380px;
            background-position: center;
        }

        .page-header {
            height: 100vh;
            background-size: cover;
            margin: 0;
            padding: 0;
            border: 0;
            display: flex;
            align-items: center;
        }

        .header-filter:after,
        .header-filter:before {
            position: absolute;
            z-index: 1;
            width: 100%;
            height: 100%;
            display: block;
            left: 0;
            top: 0;
            content: "";
        }

        .header-filter::before {
            background: rgba(0, 0, 0, .5);
        }

        .main-raised {
            margin: -60px 30px 0;
            border-radius: 6px;
            box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2);
        }

        .main {
            background: #FFF;
            position: relative;
            z-index: 3;
        }

        .profile-page .profile {
            text-align: center;
        }

        .profile-page .profile img {
            max-width: 160px;
            width: 100%;
            margin: 0 auto;
            -webkit-transform: translate3d(0, -50%, 0);
            -moz-transform: translate3d(0, -50%, 0);
            -o-transform: translate3d(0, -50%, 0);
            -ms-transform: translate3d(0, -50%, 0);
            transform: translate3d(0, -50%, 0);
        }

        .img-raised {
            box-shadow: 0 5px 15px -8px rgba(0, 0, 0, .24), 0 8px 10px -5px rgba(0, 0, 0, .2);
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .img-fluid,
        .img-thumbnail {
            max-width: 100%;
            height: auto;
        }

        .title {
            margin-top: 30px;
            margin-bottom: 25px;
            min-height: 32px;
            color: #3C4858;
            font-weight: 700;
            font-family: "Roboto Slab", "Times New Roman", serif;
        }

        .profile-page .description {
            margin: 1.071rem auto 0;
            max-width: 600px;
            color: #999;
            font-weight: 300;
        }

        p {
            font-size: 14px;
            margin: 0 0 10px;
        }

        .profile-page .profile-tabs {
            margin-top: 4.284rem;
        }

        .nav-pills,
        .nav-tabs {
            border: 0;
            border-radius: 3px;
            padding: 0 15px;
        }

        .nav .nav-item {
            position: relative;
            margin: 0 2px;
        }

        .nav-pills.nav-pills-icons .nav-item .nav-link {
            border-radius: 4px;
        }

        .nav-pills .nav-item .nav-link.active {
            color: #fff;
            background-color: #9c27b0;
            box-shadow: 0 5px 20px 0 rgba(0, 0, 0, .2), 0 13px 24px -11px rgba(156, 39, 176, .6);
        }

        .nav-pills .nav-item .nav-link {
            line-height: 24px;
            font-size: 12px;
            font-weight: 500;
            min-width: 100px;
            color: #555;
            transition: all .3s;
            border-radius: 30px;
            padding: 10px 15px;
            text-align: center;
        }

        .nav-pills .nav-item .nav-link:not(.active):hover {
            background-color: rgba(200, 200, 200, .2);
        }


        .nav-pills .nav-item i {
            display: block;
            font-size: 30px;
            padding: 15px 0;
        }

        .tab-space {
            padding: 20px 0 50px;
        }

        .profile-page .gallery {
            margin-top: 3.213rem;
            padding-bottom: 50px;
        }

        .profile-page .gallery img {
            width: 100%;
            margin-bottom: 2.142rem;
        }

        .profile-page .profile .name {
            margin-top: -80px;
        }

        img.rounded {
            border-radius: 6px !important;
        }

        .tab-content>.active {
            display: block;
        }

        /*buttons*/
        .btn {
            position: relative;
            padding: 12px 30px;
            margin: .3125rem 1px;
            font-size: .75rem;
            font-weight: 400;
            line-height: 1.428571;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0;
            border: 0;
            border-radius: .2rem;
            outline: 0;
            transition: box-shadow .2s cubic-bezier(.4, 0, 1, 1), background-color .2s cubic-bezier(.4, 0, .2, 1);
            will-change: box-shadow, transform;
        }

        .btn.btn-just-icon {
            font-size: 20px;
            height: 41px;
            min-width: 41px;
            width: 41px;
            padding: 0;
            overflow: hidden;
            position: relative;
            line-height: 41px;
        }

        .btn.btn-just-icon fa {
            margin-top: 0;
            position: absolute;
            width: 100%;
            transform: none;
            left: 0;
            top: 0;
            height: 100%;
            line-height: 41px;
            font-size: 20px;
        }

        .btn.btn-link {
            background-color: transparent;
            color: #999;
        }

        /* dropdown */




        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            float: left;
            min-width: 11rem !important;
            margin: .125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            background-color: #fff;
            background-clip: padding-box;
            border-radius: .25rem;
            transition: transform .3s cubic-bezier(.4, 0, .2, 1), opacity .2s cubic-bezier(.4, 0, .2, 1);
        }

        .dropdown-menu.show {
            transition: transform .3s cubic-bezier(.4, 0, .2, 1), opacity .2s cubic-bezier(.4, 0, .2, 1);
        }


        .dropdown-menu .dropdown-item:focus,
        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu a:active,
        .dropdown-menu a:focus,
        .dropdown-menu a:hover {
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .14), 0 7px 10px -5px rgba(156, 39, 176, .4);
            background-color: #9c27b0;
            color: #FFF;
        }

        .show .dropdown-toggle:after {
            transform: rotate(180deg);
        }

        .dropdown-toggle:after {
            will-change: transform;
            transition: transform .15s linear;
        }


        .dropdown-menu .dropdown-item,
        .dropdown-menu li>a {
            position: relative;
            width: auto;
            display: flex;
            flex-flow: nowrap;
            align-items: center;
            color: #333;
            font-weight: 400;
            text-decoration: none;
            font-size: .8125rem;
            border-radius: .125rem;
            margin: 0 .3125rem;
            transition: all .15s linear;
            min-width: 7rem;
            padding: 0.625rem 1.25rem;
            min-height: 1rem !important;
            overflow: hidden;
            line-height: 1.428571;
            text-overflow: ellipsis;
            word-wrap: break-word;
        }

        .dropdown-menu.dropdown-with-icons .dropdown-item {
            padding: .75rem 1.25rem .75rem .75rem;
        }

        .dropdown-menu.dropdown-with-icons .dropdown-item .material-icons {
            vertical-align: middle;
            font-size: 24px;
            position: relative;
            margin-top: -4px;
            top: 1px;
            margin-right: 12px;
            opacity: .5;
        }



        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }


        /*avatar*/
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input+label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 5px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview>div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .avatar-group {
            display: inline-flex;
        }

        .avatar-group .avatar {
            position: relative;
            display: inline-block;
            width: 30px;
            height: 30px;
            font-size: 1rem;
            margin-left: -0.8rem;
            transition: transform 0.2s;
        }

        .avatar-group .avatar img {
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
            border: 2px solid #ffffff;
        }

        .avatar-group .avatar:hover {
            -webkit-mask-image: none;
            mask-image: none;
            z-index: 1;
            transform: scale(1.1);
        }
    </style>

</head>

<body class="profile-page">

    <div class="page-header header-filter" data-parallax="true"
        style="background-image:url('{{ filePath($user->cover) }}');">
    </div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile">
                            <div class="avatar">
                                <img src="{{ filePath($user->avatar) }}" alt="Circle Image"
                                    class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                                <h3 class="title">{{ $user->name }}</h3>
                                <h6>{{ $user->f_name }} {{ $user->l_name }} </h6>
                                <h6>{{ $user->designation }}</h6>
                                @if ($user->id != Auth::id())
                                    <h6> <a href="#" class="danger delete-conversation"><i
                                                class="fas fa-trash-alt"></i> Delete Conversation</a></h6>
                                @endif
                                @if ($user->website != null)
                                    <a href="{{ $user->website }}" target="_blank"
                                        class="btn btn-just-icon btn-link btn-dribbble"><i
                                            class="fa fa-dribbble"></i></a>
                                @endif

                                @if ($user->facebook != null)
                                    <a href="{{ $user->facebook }}" target="_blank"
                                        class="btn btn-just-icon btn-link btn-dribbble"><i
                                            class="fa fa-facebook"></i></a>
                                @endif

                                @if ($user->twiter != null)
                                    <a href="{{ $user->twiter }}" target="_blank"
                                        class="btn btn-just-icon btn-link btn-dribbble"><i
                                            class="fa fa-twitter"></i></a>
                                @endif
                                @if ($user->instragram != null)
                                    <a href="{{ $user->instragram }}" target="_blank"
                                        class="btn btn-just-icon btn-link btn-dribbble"><i
                                            class="fa fa-instagram"></i></a>
                                @endif

                                @if ($user->whats_app != null)
                                    <a href="{{ $user->whats_app }}" target="_blank"
                                        class="btn btn-just-icon btn-link btn-dribbble"><i
                                            class="fa fa-whatsapp"></i></a>
                                @endif

                                @if ($user->telegram != null)
                                    <a href="{{ $user->telegram }}" target="_blank"
                                        class="btn btn-just-icon btn-link btn-dribbble"><i
                                            class="fa fa-telegram"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="description text-center">
                    <p>{!! nl2br($user->bio) !!}</p>
                </div>
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile-tabs">
                            <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#studio" role="tab" data-toggle="tab">
                                        <i class="fa fa-user"></i>
                                        profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#works" role="tab" data-toggle="tab">
                                        <i class="fa fa-picture-o"></i>
                                        Work
                                    </a>
                                </li>
                                @if ($user->id == Auth::id())
                                    <li class="nav-item">
                                        <a class="nav-link" href="#profile" role="tab" data-toggle="tab">
                                            <i class="fa fa-user-circle-o"></i>
                                            Update profile
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tab-content tab-space">
                    <div class="tab-pane active text-center gallery" id="studio">



                        <div class="form-group">
                            <label for="inputEmail4">Email</label>
                            <input readonly type="email" readonly class="form-control" value="{{ $user->email }}"
                                placeholder="Email">
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">First Name</label>
                                <input readonly type="text" name="f_name" class="form-control"
                                    value="{{ $user->f_name }}" placeholder="First name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Last Name</label>
                                <input readonly type="text" name="l_name" class="form-control"
                                    value="{{ $user->l_name }}" placeholder="Last name">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputAddress">Bio</label>
                            <textarea readonly name="bio" class="form-control">{!! nl2br($user->bio) !!}</textarea>

                        </div>




                        <div class="form-group">
                            <label for="inputEmail4">Phone Number</label>
                            <input type="tel" readonly name="phone" class="form-control"
                                value="{{ $user->phone }}" placeholder="Phone">
                        </div>

                        <div class="form-group">
                            <label for="inputEmail4">Gender</label>
                            <input type="tel" readonly name="genders" class="form-control"
                                value="{{ $user->genders }}" placeholder="Phone">
                        </div>



                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <textarea name="address" readonly class="form-control">{!! nl2br($user->address) !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress2">City</label>
                            <input type="text" readonly value="{{ $user->city }}" name="city"
                                class="form-control" id="inputAddress2" placeholder="City">
                        </div>
                    </div>

                    <div class="tab-pane text-center gallery" id="works">
                        <div class="shared-photos-list"></div>
                    </div>
                    @if ($user->id == Auth::id())
                        <div class="tab-pane text-center gallery" id="profile">
                            <div class="row">
                                <form method="post" action="{{ route('profile.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ routeValEncode($user->id) }}">
                                    <div class="form-group">
                                        <label for="inputEmail4">Name</label>
                                        <input type="text" readonly class="form-control"
                                            value="{{ $user->name }}" placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" readonly class="form-control"
                                            value="{{ $user->email }}" placeholder="Email">
                                    </div>

                                    {{-- update data --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">First Name</label>
                                            <input type="text" name="f_name" class="form-control"
                                                value="{{ $user->f_name }}" placeholder="First name">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Last Name</label>
                                            <input type="text" name="l_name" class="form-control"
                                                value="{{ $user->l_name }}" placeholder="Last name">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="inputAddress">Bio</label>
                                        <textarea name="bio" class="form-control">{!! nl2br($user->bio) !!}</textarea>

                                    </div>


                                    <div class="form-group">
                                        <label for="inputEmail4">Designation</label>
                                        <input type="text" name="designation" class="form-control"
                                            value="{{ $user->designation }}" placeholder="Sesignation">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail4">Phone Number</label>
                                        <input type="tel" name="phone" class="form-control"
                                            value="{{ $user->phone }}" placeholder="Phone">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputState">Select gender</label>
                                        <select id="inputState" class="form-control">
                                            <option>Choose...</option>
                                            <option value="Male" {{ $user->genders == 'Male' ? 'selected' : null }}>
                                                Male</option>
                                            <option value="Female"
                                                {{ $user->genders == 'Female' ? 'selected' : null }}>
                                                Female</option>
                                            <option value="Other"
                                                {{ $user->genders == 'Other' ? 'selected' : null }}>
                                                Other</option>
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="avatar">Profile avatar</label>
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' name="avatar" id="imageUpload_f_icon"
                                                        accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload_f_icon"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview_f_icon"
                                                        style="background-image: url({{ filePath($user->avatar) }});">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <input type="file" name="avatar" class="form-control" placeholder="Phone"
                                        id="avatar"> --}}
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="cover">Profile Cover Photo</label>

                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' name="cover" id="imageUpload_f_logo"
                                                        accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload_f_logo"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview_f_logo"
                                                        style="background-image: url({{ filePath($user->cover) }});">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <input type="file" name="cover" class="form-control" placeholder="Phone"
                                        id="cover"> --}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Address</label>
                                        <textarea name="address" class="form-control">{!! nl2br($user->address) !!}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputAddress2">City</label>
                                        <input type="text" value="{{ $user->city }}" name="city"
                                            class="form-control" id="inputAddress2" placeholder="City">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputCity">Website </label>
                                            <input type="text" name="website" value="{{ $user->website }}"
                                                class="form-control" id="inputCity">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputCity">facebook </label>
                                            <input type="text" name="facebook" value="{{ $user->facebook }}"
                                                class="form-control" id="inputCity">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputCity">Twitter </label>
                                            <input type="text" name="twiter" value="{{ $user->twiter }}"
                                                class="form-control" id="inputCity">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputCity">Instagram </label>
                                            <input type="text" name="instragram" value="{{ $user->instragram }}"
                                                class="form-control" id="inputCity">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputCity">Whats app </label>
                                            <input type="text" name="whats_app" value="{{ $user->whats_app }}"
                                                class="form-control" id="inputCity">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputCity">Telegram </label>
                                            <input type="text" name="telegram" value="{{ $user->telegram }}"
                                                class="form-control" id="inputCity">
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>

                                </form>
                            </div>
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </div>


    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
        integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>

    <script>
        var big_image;

        $(document).ready(function() {
            BrowserDetect.init();

            // Init Material scripts for buttons ripples, inputs animations etc, more info on the next link https://github.com/FezVrasta/bootstrap-material-design#materialjs
            // $('body').bootstrapMaterialDesign();

            window_width = $(window).width();

            $navbar = $('.navbar[color-on-scroll]');
            scroll_distance = $navbar.attr('color-on-scroll') || 500;

            $navbar_collapse = $('.navbar').find('.navbar-collapse');

            //  Activate the Tooltips
            $('[data-toggle="tooltip"], [rel="tooltip"]').tooltip();

            // Activate Popovers
            $('[data-toggle="popover"]').popover();

            if ($('.navbar-color-on-scroll').length != 0) {
                $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);
            }

            materialKit.checkScrollForTransparentNavbar();

            if (window_width >= 768) {
                big_image = $('.page-header[data-parallax="true"]');
                if (big_image.length != 0) {
                    $(window).on('scroll', materialKit.checkScrollForParallax);
                }

            }


        });

        $(document).on('click', '.navbar-toggler', function() {
            $toggle = $(this);

            if (materialKit.misc.navbar_menu_visible == 1) {
                $('html').removeClass('nav-open');
                materialKit.misc.navbar_menu_visible = 0;
                $('#bodyClick').remove();
                setTimeout(function() {
                    $toggle.removeClass('toggled');
                }, 550);

                $('html').removeClass('nav-open-absolute');
            } else {
                setTimeout(function() {
                    $toggle.addClass('toggled');
                }, 580);


                div = '<div id="bodyClick"></div>';
                $(div).appendTo("body").click(function() {
                    $('html').removeClass('nav-open');

                    if ($('nav').hasClass('navbar-absolute')) {
                        $('html').removeClass('nav-open-absolute');
                    }
                    materialKit.misc.navbar_menu_visible = 0;
                    $('#bodyClick').remove();
                    setTimeout(function() {
                        $toggle.removeClass('toggled');
                    }, 550);
                });

                if ($('nav').hasClass('navbar-absolute')) {
                    $('html').addClass('nav-open-absolute');
                }

                $('html').addClass('nav-open');
                materialKit.misc.navbar_menu_visible = 1;
            }
        });

        materialKit = {
            misc: {
                navbar_menu_visible: 0,
                window_width: 0,
                transparent: true,
                fixedTop: false,
                navbar_initialized: false,
                isWindow: document.documentMode || /Edge/.test(navigator.userAgent)
            },

            initFormExtendedDatetimepickers: function() {
                $('.datetimepicker').datetimepicker({
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-chevron-up",
                        down: "fa fa-chevron-down",
                        previous: 'fa fa-chevron-left',
                        next: 'fa fa-chevron-right',
                        today: 'fa fa-screenshot',
                        clear: 'fa fa-trash',
                        close: 'fa fa-remove'
                    }
                });
            },

            initSliders: function() {
                // Sliders for demo purpose
                var slider = document.getElementById('sliderRegular');

                noUiSlider.create(slider, {
                    start: 40,
                    connect: [true, false],
                    range: {
                        min: 0,
                        max: 100
                    }
                });

                var slider2 = document.getElementById('sliderDouble');

                noUiSlider.create(slider2, {
                    start: [20, 60],
                    connect: true,
                    range: {
                        min: 0,
                        max: 100
                    }
                });
            },

            checkScrollForParallax: function() {
                oVal = ($(window).scrollTop() / 3);
                big_image.css({
                    'transform': 'translate3d(0,' + oVal + 'px,0)',
                    '-webkit-transform': 'translate3d(0,' + oVal + 'px,0)',
                    '-ms-transform': 'translate3d(0,' + oVal + 'px,0)',
                    '-o-transform': 'translate3d(0,' + oVal + 'px,0)'
                });
            },

            checkScrollForTransparentNavbar: debounce(function() {
                if ($(document).scrollTop() > scroll_distance) {
                    if (materialKit.misc.transparent) {
                        materialKit.misc.transparent = false;
                        $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                    }
                } else {
                    if (!materialKit.misc.transparent) {
                        materialKit.misc.transparent = true;
                        $('.navbar-color-on-scroll').addClass('navbar-transparent');
                    }
                }
            }, 17)
        };

        // Returns a function, that, as long as it continues to be invoked, will not
        // be triggered. The function will be called after it stops being called for
        // N milliseconds. If `immediate` is passed, trigger the function on the
        // leading edge, instead of the trailing.

        function debounce(func, wait, immediate) {
            var timeout;
            return function() {
                var context = this,
                    args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                }, wait);
                if (immediate && !timeout) func.apply(context, args);
            };
        };

        // avatar preview

        function imageUpload(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview").css(
                        "background-image",
                        "url(" + e.target.result + ")"
                    );
                    $("#imagePreview").hide();
                    $("#imagePreview").fadeIn(350);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function() {
            imageUpload(this);
        });

        function imageUploadFIcon(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview_f_icon").css(
                        "background-image",
                        "url(" + e.target.result + ")"
                    );
                    $("#imagePreview_f_icon").hide();
                    $("#imagePreview_f_icon").fadeIn(350);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload_f_icon").change(function() {
            imageUploadFIcon(this);
        });

        function imageUploadFLogo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview_f_logo").css(
                        "background-image",
                        "url(" + e.target.result + ")"
                    );
                    $("#imagePreview_f_logo").hide();
                    $("#imagePreview_f_logo").fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload_f_logo").change(function() {
            imageUploadFLogo(this);
        });

        var BrowserDetect = {
            init: function() {
                this.browser = this.searchString(this.dataBrowser) || "Other";
                this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator
                    .appVersion) || "Unknown";
            },
            searchString: function(data) {
                for (var i = 0; i < data.length; i++) {
                    var dataString = data[i].string;
                    this.versionSearchString = data[i].subString;

                    if (dataString.indexOf(data[i].subString) !== -1) {
                        return data[i].identity;
                    }
                }
            },
            searchVersion: function(dataString) {
                var index = dataString.indexOf(this.versionSearchString);
                if (index === -1) {
                    return;
                }

                var rv = dataString.indexOf("rv:");
                if (this.versionSearchString === "Trident" && rv !== -1) {
                    return parseFloat(dataString.substring(rv + 3));
                } else {
                    return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
                }
            },

            dataBrowser: [{
                    string: navigator.userAgent,
                    subString: "Chrome",
                    identity: "Chrome"
                },
                {
                    string: navigator.userAgent,
                    subString: "MSIE",
                    identity: "Explorer"
                },
                {
                    string: navigator.userAgent,
                    subString: "Trident",
                    identity: "Explorer"
                },
                {
                    string: navigator.userAgent,
                    subString: "Firefox",
                    identity: "Firefox"
                },
                {
                    string: navigator.userAgent,
                    subString: "Safari",
                    identity: "Safari"
                },
                {
                    string: navigator.userAgent,
                    subString: "Opera",
                    identity: "Opera"
                }
            ]

        };
    </script>



</body>

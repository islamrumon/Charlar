{{-- user info and avatar --}}
{{-- <div class="avatar av-l chatify-d-flex"></div>
<p class="info-name">{{ config('chatify.name') }}</p>
<div class="messenger-infoView-btns">
    <a href="#" class="default"><i class="fas fa-camera"></i> default</a>
    <a href="#" class="danger delete-conversation"><i class="fas fa-trash-alt"></i> Delete Conversation</a>
</div> --}}
{{-- shared photos --}}
{{-- <div class="messenger-infoView-shared">
    <nav>
        <div class="nav nav-tabs nav-justified nav-pills profile-tab" id="nav-tab" role="tablist">

            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>

            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Share Photos</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="shared-photos-list"></div>
        </div>

    </div>

</div> --}}

@php
    if (!isset($user)) {
        $user = Auth::user();
    }
@endphp

<div class="page-header header-filter" data-parallax="true" style="background-image:url('{{ filePath($user->cover) }}');">
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
                                <a href="{{ $user->website }}" target="_blank" class="btn btn-just-icon btn-link ">
                                    <img src="{{ filePath('internet.png') }}" width="24px" height="24px">
                                </a>
                            @endif

                            @if ($user->facebook != null)
                                <a href="{{ $user->facebook }}" target="_blank" class="btn btn-just-icon btn-link ">
                                    <img src="{{ filePath('facebook.png') }}" width="24px" height="24px">
                                </a>
                            @endif

                            @if ($user->twiter != null)
                                <a href="{{ $user->twiter }}" target="_blank" class="btn btn-just-icon btn-link ">
                                    <img src="{{ filePath('twitter.png') }}" width="24px" height="24px">
                                </a>
                            @endif
                            @if ($user->instragram != null)
                                <a href="{{ $user->instragram }}" target="_blank" class="btn btn-just-icon btn-link ">

                                    <img src="{{ filePath('Instagram.png') }}" width="24px" height="24px"></a>
                            @endif

                            @if ($user->whats_app != null)
                                <a href="{{ $user->whats_app }}" target="_blank" class="btn btn-just-icon btn-link ">

                                    <img src="{{ filePath('whatsapp.png') }}" width="24px" height="24px">
                                </a>
                            @endif

                            @if ($user->telegram != null)
                                <a href="{{ $user->telegram }}" target="_blank" class="btn btn-just-icon btn-link ">
                                    <img src="{{ filePath('telegram.png') }}" width="24px" height="24px">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="description text-center">
                <p>{!! nl2br($user->bio) !!}</p>
            </div>
            <div class="row">
                <div class="col-md-12 ml-auto mr-auto">
                    <div class="profile-tabs">
                        <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#studio" role="tab" data-toggle="tab">
                                    <img src="{{ filePath($user->avatar) }}" width="24px" height="24px">

                                    profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#works" role="tab" data-toggle="tab">
                                    <img src="{{ filePath('picture.png') }}" width="24px" height="24px">
                                    Images
                                </a>
                            </li>
                            @if ($user->id == Auth::id())
                                <li class="nav-item">
                                    <a class="nav-link" href="#profile" role="tab" data-toggle="tab">
                                        <img src="{{ filePath('update_image.png') }}" width="24px" height="24px">
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
                                    <input type="text" readonly class="form-control" value="{{ $user->name }}"
                                        placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" readonly class="form-control" value="{{ $user->email }}"
                                        placeholder="Email">
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
                                        <option value="Female" {{ $user->genders == 'Female' ? 'selected' : null }}>
                                            Female</option>
                                        <option value="Other" {{ $user->genders == 'Other' ? 'selected' : null }}>
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

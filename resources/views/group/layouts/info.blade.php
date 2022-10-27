@if (isset($group) && isset($users)) {
    <div class="page-header header-filter" data-parallax="true"
        style="background-image:url('{{ filePath($group->cover) }}');">
    </div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <div class="profile">
                            <div class="avatar">
                                <img src="{{ filePath($group->avatar) }}" alt="Circle Image"
                                    class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                                <h3 class="title">{{ $group->name }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="description text-center">
                    <p>{!! nl2br($group->about) !!}</p>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item active" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="true">Images</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="false">Members</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Add
                            Member</button>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade gallery  show active" id="contact" role="tabpanel"
                        aria-labelledby="contact-tab">
                        <div class="shared-photos-list"></div>
                    </div>
                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <ul class="list-group">
                            @foreach ($users as $user)
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center member-{{ $user->id }}">
                                    {{-- Avatar side --}}

                                    <div class="avatar av-m"
                                        style="background-image: url('{{ filePath($user->avatar) }}');">
                                    </div>
                                    <p>
                                        {{ strlen($user->name) > 12 ? trim(substr($user->name, 0, 12)) . '..' : $user->name }}
                                    </p>

                                    @if ($group->admin_id == $user->id)
                                        <span>Group Admin</span>
                                    @else
                                        <button type="button"
                                            onclick="removeFromGroup('{{ route('remove.from.group', [$group->id, $user->id]) }}')"
                                            class="btn btn-sm btn-danger">Remove</button>
                                    @endif


                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <livewire:group-member-add :id="routeValEncode($group->id)" />
                    </div>

                </div>


            </div>
        </div>
    </div>

    @else

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
                    <div class="container">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            
                            <li class="nav-item active" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact" aria-selected="true">Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="false">Images</button>
                            </li>
                            @if ($user->id == Auth::id())
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">Update profile
                                    </button>
                            </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade gallery  show active" id="contact" role="tabpanel"
                aria-labelledby="contact-tab">



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

                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="shared-photos-list"></div>
                </div>
                @if ($user->id == Auth::id())
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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

                       
                        </div>
                    </div>
                @endif
            </div>


        </div>
    </div>
</div>
@endif

@if (isset($group) && isset($users))
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
                                <h5 class="font-bold">{{ ucfirst($group->type) }} Group</h5>

                            </div>
                            <p class="font-bold">Admin {{ ucfirst($group->admin->name) }} </p>
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
                                        {{ strlen($user->name) > 18 ? trim(substr($user->name, 0, 18)) . '..' : $user->name }}
                                    </p>

                                    @if ($group->admin_id == $user->id)
                                        @if ($group->admin_id != Auth::id())
                                            <button type="button"
                                                onclick="removeFromGroup('{{ route('remove.from.group', [$group->id, $user->id]) }}')"
                                                class="btn btn-sm btn-danger">Remove User</button>
                                        @else
                                            <span>Group Admin</span>
                                        @endif
                                    @else
                                        @if ($user->id == Auth::id())
                                            <button type="button"
                                                onclick="removeFromGroup('{{ route('remove.from.group', [$group->id, $user->id]) }}')"
                                                class="btn btn-sm btn-danger">Remove Self</button>
                                        @else
                                            <button type="button"
                                                onclick="removeFromGroup('{{ route('remove.from.group', [$group->id, $user->id]) }}')"
                                                class="btn btn-sm btn-danger">Remove User</button>
                                        @endif
                                    @endif


                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-header">
                                <input type="hidden" id="group_id" value="{{ $group->id }}">
                                <input type="text" onkeyup="searchUser()" id="serarchUser" class="form-control"
                                    placeholder="Search friends" />
                            </div>
                            <div class="card-body">

                                <ul class="list-group appendUsers">

                                </ul>
                            </div>
                        </div>

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
    <div class="page-header header-filter group-message" data-parallax="true"
        style="background-image:url('{{ filePath($user->cover) }}');">
    </div>
    <div class="main main-raised">
        <div class="profile-content group-message-profile py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <div class="profile">
                            <div class="avatar">
                                <img src="{{ filePath($user->avatar) }}" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                                <h3 class="title">AA {{ $user->name }}</h3>
                                <h6>{{ $user->f_name }} {{ $user->l_name }} </h6>
                                <h6>{{ $user->designation }}</h6>
                                @if ($user->id != Auth::id())
                                    <h6> <a href="#" class="danger delete-conversation"><i
                                                class="fas fa-trash-alt"></i> Delete Conversation</a></h6>
                                @endif
                                @if ($user->website != null)
                                    <a href="{{ $user->website }}" target="_blank"
                                        class="btn btn-just-icon btn-link ">
                                        <img src="{{ filePath('internet.png') }}" width="24px" height="24px">
                                    </a>
                                @endif

                                @if ($user->facebook != null)
                                    <a href="{{ $user->facebook }}" target="_blank"
                                        class="btn btn-just-icon btn-link ">
                                        <img src="{{ filePath('facebook.png') }}" width="24px" height="24px">
                                    </a>
                                @endif

                                @if ($user->twiter != null)
                                    <a href="{{ $user->twiter }}" target="_blank"
                                        class="btn btn-just-icon btn-link ">
                                        <img src="{{ filePath('twitter.png') }}" width="24px" height="24px">
                                    </a>
                                @endif
                                @if ($user->instragram != null)
                                    <a href="{{ $user->instragram }}" target="_blank"
                                        class="btn btn-just-icon btn-link ">

                                        <img src="{{ filePath('Instagram.png') }}" width="24px"
                                            height="24px"></a>
                                @endif

                                @if ($user->whats_app != null)
                                    <a href="{{ $user->whats_app }}" target="_blank"
                                        class="btn btn-just-icon btn-link ">

                                        <img src="{{ filePath('whatsapp.png') }}" width="24px" height="24px">
                                    </a>
                                @endif

                                @if ($user->telegram != null)
                                    <a href="{{ $user->telegram }}" target="_blank"
                                        class="btn btn-just-icon btn-link ">
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
                <ul class="nav nav-tabs d-flex justify-content-center my-2" id="myTab" role="tablist">

                    <li class="nav-item active" role="presentation">
                        <button class="nav-link active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="16" height="16" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g>
                                    <g>
                                        <g>
                                            <path d="M437.02,330.98c-27.883-27.882-61.071-48.523-97.281-61.018C378.521,243.251,404,198.548,404,148
                                            C404,66.393,337.607,0,256,0S108,66.393,108,148c0,50.548,25.479,95.251,64.262,121.962
                                            c-36.21,12.495-69.398,33.136-97.281,61.018C26.629,379.333,0,443.62,0,512h40c0-119.103,96.897-216,216-216s216,96.897,216,216
                                            h40C512,443.62,485.371,379.333,437.02,330.98z M256,256c-59.551,0-108-48.448-108-108S196.449,40,256,40
                                            c59.551,0,108,48.448,108,108S315.551,256,256,256z" fill="#000000" data-original="#000000">
                                            </path>
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                </g></svg>
                            <br >
                            Profile
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="16" height="16" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><g><path d="m17.453 24c-.168 0-.34-.021-.51-.066l-15.463-4.141c-1.06-.292-1.692-1.39-1.414-2.45l1.951-7.272c.072-.267.346-.422.612-.354.267.071.425.346.354.612l-1.95 7.27c-.139.53.179 1.082.71 1.229l15.457 4.139c.531.14 1.079-.176 1.217-.704l.781-2.894c.072-.267.346-.426.613-.353.267.072.424.347.353.613l-.78 2.89c-.235.89-1.045 1.481-1.931 1.481z" fill="#000000" data-original="#000000" class=""></path></g><g><path d="m22 18h-16c-1.103 0-2-.897-2-2v-12c0-1.103.897-2 2-2h16c1.103 0 2 .897 2 2v12c0 1.103-.897 2-2 2zm-16-15c-.551 0-1 .449-1 1v12c0 .551.449 1 1 1h16c.551 0 1-.449 1-1v-12c0-.551-.449-1-1-1z" fill="#000000" data-original="#000000" class=""></path></g><g><path d="m9 9c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" fill="#000000" data-original="#000000" class=""></path></g><g><path d="m4.57 16.93c-.128 0-.256-.049-.354-.146-.195-.195-.195-.512 0-.707l4.723-4.723c.566-.566 1.555-.566 2.121 0l1.406 1.406 3.892-4.67c.283-.339.699-.536 1.142-.54h.011c.438 0 .853.19 1.139.523l5.23 6.102c.18.209.156.525-.054.705-.209.18-.524.157-.705-.054l-5.23-6.102c-.097-.112-.231-.174-.38-.174-.104-.009-.287.063-.384.18l-4.243 5.091c-.09.108-.221.173-.362.179-.142.01-.277-.046-.376-.146l-1.793-1.793c-.189-.188-.518-.188-.707 0l-4.723 4.723c-.097.097-.225.146-.353.146z" fill="#000000" data-original="#000000" class=""></path></g></g></svg>
                            <br >
                            Images
                        </button>
                    </li>
                    @if ($user->id == Auth::id())
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="16" height="16" x="0" y="0" viewBox="0 0 100 100" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="m46.556 5.456c-15.54 0-27.907 7.802-35.6 16.456l.402-18.869c.023-1.104-.854-2.019-1.957-2.043-1.074.011-2.02.854-2.043 1.957l-.518 24.358c-.385.873-.099 1.922.722 2.469.589.393 1.309.43 1.914.167l24.357-.517c1.104-.023 1.981-.938 1.958-2.042-.023-1.091-.914-1.958-1.999-1.958h-.043l-20.908.444c6.804-8.188 18.764-16.423 33.714-16.423 27.908 0 42.772 24.84 42.772 42.771 0 20.656-17.188 42.772-42.772 42.772-13.752 0-26.317-6.568-34.475-18.021-.64-.899-1.891-1.11-2.789-.469-.899.641-1.109 1.89-.469 2.789 8.917 12.521 22.67 19.701 37.732 19.701 27.979 0 46.772-24.185 46.772-46.772s-18.792-46.77-46.77-46.77z" fill="#000000" data-original="#000000" class=""></path></g></svg>
                                <br >
                                Update
                            </button>
                        </li>
                    @endif

                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade gallery  show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        @if(isset($user->f_name) && isset($user->l_name))
                            <p class="user-info d-flex justify-align-content"><i class='bx bx-user'></i>&nbsp;{{ $user->f_name }} {{ $user->l_name }}</p>
                        @endif

                        @if(isset($user->email))
                            <p class="user-info d-flex justify-align-content"><i class='bx bx-envelope'></i>&nbsp;{{ $user->email }}</p>
                        @endif

                        @if(isset($user->phone))
                            <p class="user-info d-flex justify-align-content"><i class='bx bx-phone'></i>&nbsp;{{ $user->phone }}</p>
                        @endif

                        @if(isset($user->genders))
                            <p class="user-info d-flex justify-align-content"><i class='bx bx-user-check'></i>&nbsp;<strong>Gender :</strong>{{ $user->genders }}</p>
                        @endif

                        @if(isset($user->address))
                            <p class="user-info d-flex text-left"><i class='bx bx-home-alt'></i>&nbsp;{!! nl2br($user->address) !!}</p>
                        @endif

                        @if(isset($user->address))
                            <p class="user-info d-flex justify-align-content"><i class='bx bx-buildings'></i>&nbsp;<strong>City :</strong>{{ $user->city }}</p>
                        @endif
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
                                    {{--<div class="form-group">--}}
                                        {{--<label for="inputEmail4">Name</label>--}}
                                        {{--<input type="text" readonly class="form-control"--}}
                                            {{--value="{{ $user->name }}" placeholder="Email">--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<label for="inputEmail4">Email</label>--}}
                                        {{--<input type="email" readonly class="form-control"--}}
                                            {{--value="{{ $user->email }}" placeholder="Email">--}}
                                    {{--</div>--}}

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
                                        <div class="form-group">
                                            <label for="cover">Profile avatar</label>
                                            <input type="file" id="profile_avatar_upload" data-default-file="{{ filePath($user->avatar) }}" class="dropify form-control" name="avatar" accept=".png, .jpg, .jpeg">
                                        </div>
                                        <div class="form-group">
                                            <label for="cover">Profile Cover Photo</label>
                                            <input type="file" id="cover_photo_upload" data-default-file="{{ filePath($user->cover) }}" class="dropify form-control" name="cover" accept=".png, .jpg, .jpeg">
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
                                    <button type="submit" class="btn btn-sm btn-bg-primary custom-btn"><i class='bx bx-pencil'></i> Update Profile</button>
                                </form>


                            </div>
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </div>
@endif

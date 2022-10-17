@extends('layouts.master')
@section('title')
    @translate(User Update)
@endsection
@section('sub-title')
    <a class="nav=link" href="{{ route('users.index') }}">
        @translate(Users list)
    </a>
@endsection
@section('main-content')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">@translate(Primary Information)</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                    class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update.first') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{routeValEncode($user->id)}}">
                                <div class="row mb-2">
                                    <div class="profile-title">
                                        <div class="media"> <img class="img-70 rounded-circle" alt="{{ $user->name }}"
                                                src="{{ filePath($user->avatar) }}">
                                            <div class="media-body">
                                                <h3 class="mb-1 f-20 txt-primary">{{ Str::ucfirst($user->name) }}</h3>
                                                <p class="f-12">{{ Str::ucfirst($user->designation) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <h6 class="form-label">@translate(Bio)</h6>
                                    <textarea class="form-control" name="bio" rows="5">@pureme($user->bio)</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@translate(Username) <span class="text-danger">*</span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        placeholder="@translate(Username)" value="{{ $user->name }}" name="name" required>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label">@translate(Email - Address) <span class="text-danger">*</span></label>
                                    <input class="form-control @error('email') is-invalid @enderror"
                                        placeholder="@translate(your-email@domain.com)" value="{{ $user->email }}" readonly required>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label">@translate(Avatar)</label>
                                    <input class="form-control" type="file" name="avatar">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">@translate(User Type) </label>
                                    <select class="form-control btn-square " name="type">
                                        <option selected value="">--@translate(Select)--</option>
                                        <option value="admin" {{ $user->type == 'admin' ? 'selected' : null }}>
                                            @translate(Admin)</option>
                                        <option value="user" {{ $user->type == 'user' ? 'selected' : null }}>
                                            @translate(User)</option>

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">@translate(Select Roles)</label>
                                    <select class="form-control select2 w-100" name="group_id[]" multiple>
                                        @foreach ($groups as $item)
                                            <option value="{{ $item->id }}"
                                                @foreach ($user->groups as $item1) {{ $item1->id == $item->id ? 'selected' : null }} @endforeach>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block" type="submit">@translate(Update Save)</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <form class="card" action="{{route('users.update')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{routeValEncode($user->id)}}">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">@translate(Others Information)</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                    class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(Designation)</label>
                                        <input class="form-control" type="text" value="{{$user->designation}}" name="designation"
                                            placeholder="@translate(Designation)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(Contact Number)</label>
                                        <input class="form-control" type="tel" name="phone" value="{{$user->phone}}"
                                            placeholder="@translate(Contact number)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(First Name)</label>
                                        <input class="form-control" type="text" name="f_name" value="{{$user->f_name}}"
                                            placeholder="@translate(First Name)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(Last Name)</label>
                                        <input class="form-control" type="text" name="l_name" value="{{$user->l_name}}"
                                            placeholder="@translate(Last Name)">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(Address)</label>
                                        <input class="form-control" type="text" name="address" value="{{$user->address}}"
                                            placeholder="@translate(Home Address)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(City)</label>
                                        <input class="form-control" type="text" name="city" value="{{$user->city}}"
                                            placeholder="@translate(City)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(State)</label>
                                        <input class="form-control" type="number" name="state" value="{{$user->state}}"
                                            placeholder="@translate(State)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(Website)</label>
                                        <input class="form-control" name="website" placeholder="http://Uplor .com" value="{{$user->website}}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(Gender)</label>
                                        <select class="form-control btn-square" name="genders">
                                            <option selected value="">--@translate(Select)--</option>
                                            <option value="Male" {{$user->genders == 'Male' ? 'selected' : null}}>@translate(Male)</option>
                                            <option value="Female"  {{$user->genders == 'Female' ? 'selected' : null}}>@translate(Female)</option>
                                            <option value="Other"  {{$user->genders == 'Other' ? 'selected' : null}}>@translate(Other)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">@translate(About Me)</label>
                                        <textarea class="form-control" name="abount_me" rows="5" placeholder="@translate(Enter About your description)">@pureme($user->abount_me)</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">@translate(Update Profile)</button>
                        </div>
                    </form>
                    <!-- Container-fluid Ends-->
                </div>
            </div>
        </div>
    </div>

@endsection

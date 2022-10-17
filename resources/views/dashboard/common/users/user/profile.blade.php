@extends('layouts.master')
@section('title')
    @translate(My Profile)
@endsection

@section('sub-title')
    @translate(Details)
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
                                <textarea class="form-control" readonly name="bio" rows="5">@pureme($user->bio)</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">@translate(Username) <span class="text-danger">*</span></label>
                                <input class="form-control" readonly type="text" placeholder="@translate(Username)"
                                    value="{{ $user->name }}" name="name" required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">@translate(Email - Address) <span class="text-danger">*</span></label>
                                <input class="form-control" readonly placeholder="@translate(your-email@domain.com)"
                                    value="{{ $user->email }}" readonly required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">@translate(User Type)</label>
                                <input class="form-control" readonly value="{{ $user->type }}" required>
                            </div>




                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">

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
                                        <input class="form-control" type="text" value="{{ $user->designation }}"
                                            name="designation" readonly placeholder="@translate(Designation)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(Contact Number)</label>
                                        <input class="form-control" type="tel" readonly name="phone"
                                            value="{{ $user->phone }}" placeholder="@translate(Contact number)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(First Name)</label>
                                        <input class="form-control" readonly type="text" name="f_name"
                                            value="{{ $user->f_name }}" placeholder="@translate(First Name)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(Last Name)</label>
                                        <input class="form-control" readonly type="text" name="l_name"
                                            value="{{ $user->l_name }}" placeholder="@translate(Last Name)">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(Address)</label>
                                        <input class="form-control" readonly type="text" name="address"
                                            value="{{ $user->address }}" placeholder="@translate(Home Address)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(City)</label>
                                        <input class="form-control" readonly type="text" name="city"
                                            value="{{ $user->city }}" placeholder="@translate(City)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(State)</label>
                                        <input class="form-control" readonly type="number" name="state"
                                            value="{{ $user->state }}" placeholder="@translate(State)">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">@translate(Website)</label>
                                        <input class="form-control" readonly name="website"
                                            placeholder="http://Uplor .com" value="{{ $user->website }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label">@translate(Gender)</label>
                                        <input class="form-control" readonly name="website"
                                            value="{{ $user->genders }}">
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">@translate(About Me)</label>
                                        <textarea class="form-control" name="abount_me" rows="5" readonly placeholder="@translate(Enter About your description)">@pureme($user->abount_me)</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container-fluid Ends-->
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')
@section('title')
    @translate(User Create)
@endsection

@section('sub-title')
    <a class="" href="{{ route('users.index') }}">
        @translate(Users list)
    </a>
@endsection
@section('main-content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">@translate(Prinary Information)</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                    class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.store.first') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">@translate(Username) <span class="text-danger">*</span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        placeholder="@translate(Username)" name="name" required>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="mb-3">
                                    <label class="form-label">@translate(Email - Address) <span class="text-danger">*</span></label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        placeholder="@translate(your-email@domain.com)" name="email" required>
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
                                    <select class="form-control select2" name="type">
                                        <option selected value="">--@translate(Select)--</option>
                                        <option value="admin">@translate(Admin)</option>
                                        <option value="user">@translate(User)</option>

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <h6 class="form-label">@translate(Bio)</h6>
                                    <textarea class="form-control" name="bio" rows="5"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">@translate(Password) <span class="text-danger">*</span></label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <div class="mb-3">
                                    <label class="form-label">@translate(Select Roles)</label>
                                    <select class="form-control select2-multi w-100" name="group_id[]" multiple>
                                        @foreach ($groups as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block" type="submit">@translate(Save)</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2"></div>

            </div>
        </div>
    </div>
@endsection

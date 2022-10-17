@extends('layouts.master')
@section('title')
    @translate(Role Update)
@endsection

@section('sub-title')
    <a class="nav=link" href="{{ route('groups.index') }}">
        @translate(Role list)
    </a>
@endsection

@section('main-content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2">
                <form action="{{ route('groups.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $group->id }}" />

                    <div class="mb-3">
                        <h4 class="form-label">@translate(Name) <span class="text-danger">*</span></h4>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ $group->name }}" required placeholder="@translate(Enter the role name here)" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <hr />


                  

                    <div class="form-group">
                        <h4 class=" font-weight-bold">@translate(Select Permission)</h4>
                        <div class="col-md-12">
                            <div class="row">
                                @forelse($modules as $m)
                                    <div class="col-md-4 card p-5">
                                        <h2 class="card-title py-2">@translate(Module): {{ Str::ucfirst($m->name) }}</h2>
                                        @foreach ($m->permissions as $item)
                                            @if ($item->permission != null)
                                                <div class="media">
                                                    <label
                                                        class="col-form-label">{{ Str::ucfirst($item->permission->name) }}</label>
                                                    <div class="media-body text-end">
                                                        <label class="switch" for="customSwitch{{ $item->id }}">
                                                            <input type="checkbox"
                                                                @foreach ($group->permissions as $item12) {{ $item12->name === $item->permission->name ? 'checked' : 'null' }} @endforeach
                                                                value="{{ $item->permission->name }}"
                                                                name="permission_id[]"
                                                                id="customSwitch{{ $item->id }}"><span
                                                                class="switch-state"></span></label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @empty
                                    <span class="badge badge-danger">@translate(No permission)</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary m-2" type="submit">@translate(Update)</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

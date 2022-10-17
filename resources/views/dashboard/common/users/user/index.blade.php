@extends('layouts.master')
@section('title')
    @translate(User List)
@endsection

@section('sub-title')
    <a href="{{ route('users.create') }}">
        @translate(Add New User)
    </a>
@endsection
@section('main-content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- there are the main content-->
                <table id="basic-1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@translate(S / L)</th>
                            <th>@translate(Avatar)</th>
                            <th>@translate(Name)</th>
                            <th>@translate(Contact)</th>
                            <th>@translate(Groups)</th>
                            <th>@translate(Last Login)</th>
                            <th>@translate(Action)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr class="{{ $item->banned == true ? 'table-danger' : 'ok' }}">
                                <td>
                                    {{ $loop->index + 1 }}
                                </td>
                                <td>
                                    <img src="{{ filePath($item->avatar) }}" width="80" height="80" class="img-circle">
                                </td>
                                <td>@translate(Name) : {{ checkNull($item->name) }} <br>
                                    <strong>{{ checkNull($item->gendear) }}</strong>
                                </td>
                                <td> @translate(Email) : <a href="Mail:{{ checkNull($item->email) }}"
                                        class="text-info">{{ checkNull($item->email) }}</a><br>
                                    @translate(Phone) : <a href="Tel:{{ checkNull($item->phone) }}"
                                        class="text-info">{{ checkNull($item->phone) }}</a>
                                <td>


                                    @foreach ($item->groups as $it)
                                        <span class="badge badge-success">{{ $it->name }}</span>,
                                    @endforeach

                                </td>
                                <td>
                                    @if ($item->login_time != null)
                                        <span class="badge badge-info">{{ timeForHumans($item->login_time) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown-basic">
                                        <div class="dropdown">
                                            <div class="btn-group mb-0">
                                                <button class="dropbtn btn-primary btn-round"
                                                    type="button">@translate(Action)
                                                    <span><i class="fa fa-arrow-down"></i></span></button>
                                                <div class="dropdown-content">
                                                    @if (Auth::id() == $item->id)
                                                        <a href="{{ route('users.profile') }}">@translate(My Profile)</a>
                                                        <a href="{{ route('change.password') }}">@translate(Change Password)</a>
                                                    @endif

                                                    @if (Auth::id() != $item->id)
                                                        <a
                                                            href="{{ route('users.show', routeValEncode($item->id)) }}">@translate(Profile)</a>

                                                        @if ($item->banned)
                                                            <a href="#" class="text-success"
                                                                onclick="confirm_modal('{{ route('users.active', routeValEncode($item->id)) }}')">@translate(Active)</a>
                                                        @else
                                                            <a href="#" class="text-danger"
                                                                onclick="confirm_modal('{{ route('users.banned', routeValEncode($item->id)) }}')">@translate(Banned)</a>
                                                        @endif
                                                    @endif
                                                    <a href="{{ route('users.edit', routeValEncode($item->id)) }}">@translate(Update Profile)</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

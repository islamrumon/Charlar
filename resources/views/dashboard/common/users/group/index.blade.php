@extends('layouts.master')
@section('title')
    @translate(Role List)
@endsection
@section('sub-title')
    <a class="nav=link" href="{{ route('groups.create') }}">
        @translate(New Role Create)
    </a>
@endsection
@section('main-content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2">

                <!-- there are the main content-->
                <table id="basic-1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@translate(S / L)</th>
                            <th>@translate(Name)</th>
                            <th>@translate(Permission)</th>
                            <th>@translate(Action)</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($groups as $item)
                            <tr>
                                <td> {{ $loop->index + 1 }}</td>
                                <td>{{ Str::ucfirst($item->name) }}</td>
                                <td>
                                    @foreach ($item->permissions as $items)
                                        <span class="badge badge-success">{{ $items->name }}</span>,
                                    @endforeach
                                </td>
                                <td>
                                    <div class="dropdown-basic">
                                        <div class="dropdown">
                                            <div class="btn-group mb-0">
                                                <button class="dropbtn btn-primary btn-round"
                                                    type="button">@translate(Action)
                                                    <span><i class="fa fa-arrow-down"></i></span></button>
                                                <div class="dropdown-content">
                                                    <a href="{{ route('groups.edit', $item->id) }}">
                                                        @translate(Edit)</a>

                                                    <a  class="d-none" href="{{ route('groups.show', $item->id) }}">@translate(Show)</a>

                                                    <a class="d-none" href="javascript:void(0)"
                                                        onclick="confirm_modal('{{ route('groups.destroy', $item->id) }}')">
                                                        @translate(Delete)</a>
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

@extends('layouts.master')
@section('title')
    @translate(Permissions)
@endsection
@section('sub-title')
    @translate(List)
@endsection
@section('main-content')
    <div class="contentbar">
        <div class="row">
            <div class="col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">@translate(Permission List)</h2>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable -->
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th>@translate(S / L)</th>
                                    <th>@translate(Name)</th>
                                    <th>@translate(Permissions)</th>
                                    <th>@translate(Action)</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($modules as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ checkNull($item->name) }}</td>
                                        <td>
                                            {{-- {{$item->permissions}} --}}
                                            @forelse($item->permissions as $permission)
                                                @if ($permission->permission != null)
                                                    <snap class="badge badge-info">{{ $permission->permission->name }}</snap>
                                                @endif

                                            @empty
                                                <span class="badge badge-danger">@translate(No permission)</span>
                                            @endforelse
                                        </td>
                                        <td>
                                            <div class="dropdown-basic">
                                                <div class="dropdown">
                                                    <div class="btn-group mb-0">
                                                        <button class="dropbtn btn-primary btn-round"
                                                            type="button">@translate(Action)
                                                            <span><i class="fa fa-arrow-down"></i></span></button>
                                                        <div class="dropdown-content">
                                                            <a href="javascript:void(0)"
                                                                onclick="forModal('{{ route('modules.edit', $item->id) }}','Module permission edit')">@translate(Edit)</a>

                                                            <a href="javascript:void(0)"
                                                                onclick="confirm_modal('{{ route('modules.destroy', $item->id) }}')">
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
                        <!--end: Datatable -->
                    </div>
                </div>

            </div>
            <div class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@translate(Permission Group Setup)</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('modules.store') }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="">
                                    <label class="control-label">@translate(Name) <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="">
                                    <input type="text" class="form-control" name="name" required
                                        placeholder="@translate(Group name)">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">@translate(Select permissions) <span class="text-danger">*</span></label>
                                <div class="">
                                    <select class="form-control select2-multi" name="p_id[]" multiple required>
                                        <option value=""></option>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"> {{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12 text-right">
                                    <button class="btn btn-primary btn-block" type="submit">@translate(Save)
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--there are the main content-->
    </div>
@endsection

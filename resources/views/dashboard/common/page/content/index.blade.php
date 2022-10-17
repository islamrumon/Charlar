@extends('layouts.master')
@section('title')
    @translate(Page Content List)
@endsection

@section('sub-title')
    <a  href="{{ route('pages.content.create', $id) }}">
        @translate(Page content create)
    </a>
@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">

                <a href="{{ route('pages.content.create', $id) }}" class="btn btn-primary">
                    <i class="la la-plus"></i>
                    @translate(Content Create)
                </a>
            </div>

            <div class="card-body">
                <table class="table table-striped- table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>@translate(S / L)</th>
                            <th>@translate(Title)</th>
                            <th>@translate(Total Content)</th>
                            <th>@translate(Active)</th>
                            <th>@translate(Action)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($content as  $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    {!! $item->body !!}
                                </td>
                                <td>
                                    <div class="form-group">

                                        <input data-id="{{ $item->id }}" {{ $item->active == true ? 'checked' : null }}
                                            data-url="{{ route('pages.content.active') }}" type="checkbox"
                                            class="js-switch-primary">


                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group mr-2">
                                        <div class="dropdown">
                                            <button class="btn btn-round btn-outline-primary" type="button"
                                                id="CustomdropdownMenuButton5" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton5"
                                                x-placement="top-start">
                                                <a class="dropdown-item" href="{{ route('pages.content.edit', $item->id) }}">
                                                    <i class="feather icon-edit mr-2"></i>@translate(Content edit)</a>

                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="confirm_modal('{{ route('pages.content.destroy', $item->id) }}')">
                                                    <i class="feather icon-delete mr-2"></i>@translate(Delete)</a>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <h3 class="text-center">@translate(No Data Found)</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

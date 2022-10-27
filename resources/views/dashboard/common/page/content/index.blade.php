@extends('layouts.master')
@section('title')
    @translate(Page Content List)
@endsection

@section('sub-title')
    <a href="{{ route('pages.index') }}">
        @translate(Pages)
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
                                    <div class="media">
                                        <div class="media-body text-end">
                                            <label class="switch" for="customSwitch{{ $item->id }}">
                                                <input data-id="{{ $item->id }}" id="customSwitch{{ $item->id }}"
                                                    {{ $item->active == true ? 'checked' : null }}
                                                    data-url="{{ route('pages.content.active') }}" type="checkbox"> <span
                                                    class="switch-state"></label>

                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="dropdown-basic">
                                        <div class="dropdown">
                                            <div class="btn-group mb-0">
                                                <button class="dropbtn btn-primary btn-round"
                                                    type="button">@translate(Action)
                                                    <span></span></button>
                                                <div class="dropdown-content">

                                                    <a
                                                        href="{{ route('pages.content.edit', $item->id) }}">@translate(Content edit)</a>

                                                    <a href="javascript:void(0)"
                                                        onclick="confirm_modal('{{ route('pages.content.destroy', $item->id) }}')">
                                                        @translate(Delete)</a>

                                                </div>
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

@extends('layouts.master')
@section('title')
    @translate(Pages list)
@endsection

@section('sub-title')
    <a href="#!" onclick="forModal('{{ route('pages.create') }}', '@translate(Page Create)')" class="">

        @translate(Page Create)
    </a>
@endsection

@section('main-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <div class="card">
            <div class="card-header">
                <a href="#!" onclick="forModal('{{ route('pages.create') }}', '@translate(Page Create)')"
                    class="btn btn-primary">
                    <i class="la la-plus"></i>
                    @translate(Page Create)
                </a>
            </div>

            <div class="card-body">
                <table class="table table-striped- table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>@translate(S / L)</th>

                            <th>@translate(Title)</th>
                            <th>@translate(Total Content)</th>
                            <th>@translate(Published)</th>
                            <th>@translate(Authorize)</th>
                            <th>@translate(Action)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pages as  $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ checkNull($item->title) }} <br>
                                    {{-- <span> Url: {{ route('page', $item->slug) }}</span> --}}
                                </td>
                                <td>
                                    {{ $item->content->count() ?? 'N/A' }}
                                </td>
                                <td>
                                    <div class="media">
                                        <div class="media-body text-end">
                                            <label class="switch" for="customSwitch{{ $item->id }}">
                                            <input data-id="{{ $item->id }}" id="customSwitch{{ $item->id }}"
                                                {{ $item->active == true ? 'checked' : null }}
                                                data-url="{{ route('pages.active') }}" type="checkbox"
                                                > <span class="switch-state"></label>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="media">
                                        <div class="media-body text-end">
                                            <label class="switch" for="is_authorize{{ $item->id }}">
                                        <input data-id="{{ $item->id }}" id="is_authorize{{ $item->id }}"
                                            {{ $item->is_authorize == true ? 'checked' : null }}
                                            data-url="{{ route('pages.authorize') }}" type="checkbox"
                                            ><span class="switch-state"></label>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown-basic">
                                        <div class="dropdown">
                                            <div class="btn-group mb-0">
                                                <button class="dropbtn btn-primary btn-round"
                                                    type="button">@translate(Action)
                                                    <span><i class="fa fa-arrow-down"></i></span></button>
                                                <div class="dropdown-content">
                                                    <a href="javascript:void(0)" onclick="forModal('{{ route('pages.edit', $item->id) }}','@translate(Page Edit)')">@translate(Edit)</a>

                                                <a href="{{ route('pages.content.index', $item->id) }}">@translate(Page Content)</a>

                                                <a href="javascript:void(0)"
                                                    onclick="confirm_modal('{{ route('pages.destroy', $item->id) }}')">
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

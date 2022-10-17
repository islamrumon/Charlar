@extends('layouts.master')
@section('title') @translate(Language List) @endsection
@section('main-content')
    <div class="contentbar">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">@translate(Language List)</h2>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable -->
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@translate(Code)</th>
                                    <th>@translate(Name)</th>
                                    <th>@translate(Flag)</th>
                                    <th>@translate(Action)</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($languages as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>
                                            {{ $item->name ?? 'N/A' }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('images/lang/' . $item->image) }}" class=""
                                                height="30px" alt="" />
                                        </td>
                                        <td>
                                            <div class="btn-group mr-2">
                                                <div class="dropdown">
                                                    <button class="btn btn-round btn-outline-primary" type="button"
                                                        id="CustomdropdownMenuButton5" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"><i
                                                            class="feather icon-more-vertical-"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton5"
                                                        x-placement="top-start">

                                                        <a class="dropdown-item "
                                                            href="{{ route('language.translate', $item->id) }}">
                                                            <i class="feather icon-list"></i>
                                                            @translate(Translate)</a>


                                                        @if (env('DEFAULT_LANGUAGE') == $item->code)
                                                            <a class="dropdown-item" href="#!">
                                                                <i class="feather icon-code mr-2"></i>
                                                                @translate(It Default)</a>
                                                        @else
                                                            <a class="dropdown-item"
                                                                href="{{ route('language.default', $item->id) }}">
                                                                <i class="feather icon-code mr-2"></i>
                                                                @translate(Set Default)</a>
                                                        @endif



                                                        @if (!env('APP_DEMO'))
                                                            @if ($item->code != 'en')
                                                                <a class="dropdown-item" href="#!"
                                                                    onclick="confirm_modal('{{ route('language.destroy', $item->id) }}')">
                                                                    <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                                            @endif

                                                        @endif


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
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@translate(Language Setup)</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('language.store') }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="">
                                    <label class="control-label">@translate(Name) <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="">
                                    <input type="text" class="form-control" name="name" required
                                        placeholder="@translate(Ex: English)">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label class="control-label">@translate(Code) <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="">
                                    <input type="text" class="form-control" name="code" required
                                        placeholder="@translate(Ex: en for english)">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">@translate(Select country flag) <span
                                        class="text-danger">*</span></label>
                                <div class="">
                                    <select class="form-control lang" name="image" required>
                                        <option value=""></option>
                                        @foreach (readFlag() as $item)
                                            @if ($loop->index > 1)
                                                <option value="{{ $item }}"
                                                    data-image="{{ asset('images/lang/' . $item) }}">
                                                    {{ flagRenameAuto($item) }}</option>
                                            @endif
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
    </div>
    <!--there are the main content-->

@endsection

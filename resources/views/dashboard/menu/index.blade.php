@extends('layouts.master')
@section('title')
    @translate(Menu Builder)
@endsection
@section('meta-desc')
    @translate(Menu Builder)
@endsection
@section('meta-keys')
    @translate(Menu Builder)
@endsection
@section('style')
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link href="{{ asset('menu_assets/style.css') }}" rel="stylesheet">
@endsection
@section('main-content')
    <div class="contentbar">
        @if (!request()->has('menu') && empty(request()->input('menu')))
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-2">
                    <!-- there are the main content-->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">@translate(Menus)</h2>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable -->
                            <table class="table data-table">
                                <thead>
                                    <tr>
                                        <th>@translate(S / L)</th>
                                        <th>@translate(Name)</th>
                                        <th>@translate(Status)</th>
                                        <th>@translate(Items)</th>
                                        <th>@translate(Action)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($menus as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <a href="{{ url()->current() . '?menu=' . $item->id }}">
                                                    {{ checkNull($item->name) }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body text-end">
                                                        <label class="switch" for="is_authorize{{ $item->id }}">
                                                            <input data-id="{{ $item->id }}" id="is_authorize{{ $item->id }}"
                                                                {{ $item->is_published == true ? 'checked' : null }}
                                                                data-url="{{ route('menu.published') }}"
                                                                type="checkbox"><span class="switch-state"></label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $item->items->count() }}
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="{{ url()->current() . '?menu=' . $item->id }}">
                                                    @translate(Menu items)</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end: Datatable -->
                        </div>
                    </div>
                    <br>



                </div>

            </div>
        @else
            {!! \App\Http\WMenu::render() !!}
        @endif
    </div>

@endsection

@section('script')
    {!! \App\Http\WMenu::scripts() !!}
@endsection

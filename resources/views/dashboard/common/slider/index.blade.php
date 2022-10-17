@extends('layouts.master')
@section('title')
    @translate(Slider List)
@endsection
@section('main-content')
    <div class="contentbar">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@translate(Slider List)</h3>
                <strong>Only one slider active by default, so you entry only one Slider image<strong>

                <div class="float-right">
                    <a class="btn btn-success" onclick="forModal('{{ route("slider.create") }}','@translate(Slider Create)')" href="javascript:void()">
                        @translate(Add slider)
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2">
                <!-- there are the main content-->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>@translate(S/L)</th>
                        <th>@translate(Url)</th>
                        <th>@translate(Action)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sliders as $item)
                        <tr>
                            <td>
                                {{$loop->index+1}}
                            </td>
                            <td>
                                <img src="{{filePath($item->image)}}" width="80" height="80" class="img-circle">
                            </td>
                            <td>{{checkNull($item->url)}}</td>
                            <td>
                                <div class="form-group">
                                    <input data-id="{{$item->id}}"
                                           {{$item->is_active == true ? 'checked' : null}}  data-url="{{route('slider.active')}}"
                                           type="checkbox" class="js-switch-success">
                                </div>
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
                                            <a class="dropdown-item" onclick="forModal('{{ route('slider.edit', $item->id) }}','@translate(Slider update)')" href="javascript:void()"><i
                                                    class="feather icon-eye mr-2"></i>@translate(Edit)</a>
                                            <a class="dropdown-item" href="javascript:void(0)"
                                               onclick="confirm_modal('{{ route('slider.destroy',$item->id) }}')">
                                                <i class="feather icon-delete mr-2"></i>@translate(Delete)</a>
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

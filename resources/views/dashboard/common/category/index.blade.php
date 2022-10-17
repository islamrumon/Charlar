@extends('layouts.master')
@section('title') @translate(Categories)
@endsection
@section('main-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Categories List)</h2>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control col-12"
                                       placeholder="@translate(Category Name)" value="{{Request::get('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <a href="javascript:void(0)" onclick="forModal('{{route("categories.create")}}','@translate(Create New Category)')" class="btn btn-success" >@translate(Add Category)</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped- table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>@translate(S/L)</th>
                    <th class="text-left">@translate(Category)</th>
                    <th class="text-left">@translate(Parent category)</th>
                    <th>@translate(Popular)
                    <small>Show after slider</small>
                    </th>
                    <th>@translate(Top)
                        <small>@translate(Show after City section)</small>
                        <small> @translate(Recomendate use Parent Category in this section)</small>
                    </th>
                    <th>@translate(Icon class)</th>
                    <th>@translate(Image)</th>
                    <th>@translate(Publish)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as  $item)
                    <tr>
                        <td>{{ ($loop->index+1) }}</td>
                        <td class="text-left">{{ $item->name}}</td>
                        <td  class="text-left">
                            {{$item->parent->name ?? 'N/A'}}
                        </td>
                        <td>
                            <div class="form-group">
                                    <input data-id="{{$item->id}}"
                                           {{$item->is_popular == true ? 'checked' : null}}  data-url="{{route('categories.popular')}}"
                                           type="checkbox" class="js-switch-danger-small">


                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                    <input data-id="{{$item->id}}"
                                           {{$item->is_top == true ? 'checked' : null}}  data-url="{{route('categories.top')}}"
                                           type="checkbox" class="js-switch-primary-small">
                            </div>
                        </td>
                        <td class="text-center">
                            @if($item->icon != null)
                            <img src="{{filePath($item->icon)}}" width="80" height="80"
                            class="img-thumbnail rounded-circle" alt="{{$item->name}}">
                            @endif
                        </td>

                        <td>
                            @if($item->image != null)
                                <img src="{{filePath($item->image)}}" width="80" height="80"
                                     class="img-thumbnail rounded-circle" alt="{{$item->name}}">
                            @endif
                        </td>

                        <td>
                            <div class="form-group">
                                    <input data-id="{{$item->id}}"
                                           {{$item->is_published == true ? 'checked' : null}}  data-url="{{route('categories.published')}}"
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
                                        <a class="dropdown-item"  href="#!" onclick="forModal('{{ route('categories.edit', $item->id) }}', '@translate(Category Edit)')">
                                            <i class="feather icon-edit mr-2"></i>@translate(Edit)</a>

                                        <a class="dropdown-item" href="javascript:void(0)"
                                           onclick="confirm_modal('{{ route('categories.destroy', $item->id) }}')">
                                            <i class="feather icon-delete mr-2"></i>@translate(Delete)</a>

                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9"><h3 class="text-center">@translate(No Data Found)</h3></td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>
    </div>

@endsection

@extends('layouts.master')
@section('title') @translate(Push Notification logs) @endsection
@section('main-content')
    <div class="card ">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Push Notification logs)</h2>
            </div>
            <div class="float-right">

            </div>
        </div>

        <div class="card-body">
            <!-- there are the main content-->
            <table id="datatable" class="table table-striped- table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>@translate(S/L)</th>
                        <th>@translate(Date)</th>
                        <th class="text-left">@translate(Sender)</th>
                        <th class="text-left">@translate(Title)</th>
                        <th class="text-left">@translate(Body)</th>
                        <th>@translate(Image)</th>
                        <th>@translate(Tokens)</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as  $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                {{ dateTimeFormat($item->creatd_at) }}
                            </td>
                            <td class="text-left">
                               @if ($item->user)
                                  {{ $item->user->first_name }} </br>
                                  {{ $item->user->email}}
                               @endif
                            </td>
                            <td class="text-left">
                                {{ $item->title }}
                            </td>
                            <td>
                                {{ $item->body }}
                            </td>
                            <td>
                              <img src="{{ filePath($item->image) }}" class="img-thumbnail" width="100px" height="80px">
                            </td>

                            <td>
                                <p>{{$item->tokens }}</p>
                              </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <h3 class="text-center">@translate(No Data Found)</h3>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>


@endsection



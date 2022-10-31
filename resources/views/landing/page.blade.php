@extends('landing.master')
@section('title')
    {{ $page->title }}
@endsection

@section('meta_desc')
    {{ getSystemSetting('meta_desc') }}
@endsection

@section('meta_keys')
    {{ getSystemSetting('meta_keys') }}
@endsection

@section('meta_title')
    {{ getSystemSetting('meta_title') }}
@endsection


@section('content')
   

<div class="breadcrumb-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-inner">
            <h1 class="page-title">{{$page->title}}</h1>
            <ul class="page-list">
              <li class="active"><a href="{{route('home')}}">Home</a></li>
              <li>{{$page->title}}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

    @foreach ($page->content as $item)
        <div class="container mt-2 mb-2">
            <div class="service-details-content">
                <h2 class="service-title">{{ $item->title }}</h2>
                <p class="m-b-30"> @pureme($item->body)</p>
            </div>
        </div>
    @endforeach



    {{-- @if ($page->widgets != null)
        @foreach (json_decode($page->widgets) as $item1)
            @include('frontend.layouts.' . $item1)
        @endforeach
    @endif --}}

@endsection

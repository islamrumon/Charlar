@extends('layouts.master')
@section('title')
    @translate(Profiles)
@endsection
@section('sub-title')
    @translate(Default)
@endsection
@section('main-content')
    <!-- Container-fluid starts-->
    <livewire:profile-search /> 
    <!-- Container-fluid Ends-->
@endsection

@section('script')
@endsection

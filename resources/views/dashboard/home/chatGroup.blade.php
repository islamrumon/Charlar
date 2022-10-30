@extends('layouts.master')
@section('title')
    @translate(Chat Groups)
@endsection
@section('sub-title')
    @translate(Default)
@endsection
@section('main-content')
    <!-- Container-fluid starts-->
    <livewire:group-search /> 
    <!-- Container-fluid Ends-->
@endsection

@section('script')
@endsection

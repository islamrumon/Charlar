@extends('layouts.master')
@section('title')
    @translate(Contact)
@endsection

@section('sub-title')
    <a href="{{ route('contact.message') }}">
        @translate(request messages)
    </a>
@endsection
@section('main-content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- there are the main content-->
                <table id="basic-1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@translate(S / L)</th>
                            <th>@translate(Name)</th>
                            <th>@translate(subject)</th>
                            <th>@translate(message)</th>
                            <th>@translate(Date)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $item)
                            <tr>
                                <td>
                                    {{ $loop->index + 1 }}
                                </td>
                                <td>
                                    <p>Name: {{ $item->name }}</p>
                                    <p>Email: {{ $item->email }}</p>
                                    <p>Phone: {{ $item->phone }}</p>

                                </td>
                                <td>
                                    <p>{{ $item->subject }}</p>
                                </td>

                                <td>
                                    <p>@pureme($item->message)</p>
                                </td>

                                <td>
                                    {{ dateTimeFormat($item->created_at) }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

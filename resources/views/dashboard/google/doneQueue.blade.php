@extends('layouts.master')
@section('title')
    @translate(Proccessed Queue jobs )
@endsection
@section('sub-title')
    <a class="nav=link" href="{{ route('dashboard') }}">
        @translate(Dashboard)
    </a>
@endsection
@section('main-content')
    <div class="card ">
        <div class="card-body">
            <div class="container-fluid default-dash">
                <!-- BEGIN: Data List -->
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report -mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-no-wrap">@translate(QUEUE ID)</th>
                                <th class="text-center whitespace-no-wrap">@translate(NAME)</th>
                                <th class="text-center whitespace-no-wrap">@translate(STARTED AT)</th>
                                <th class="text-center whitespace-no-wrap">@translate(TIME ELAPSED)(s)</th>
                                <th class="text-center whitespace-no-wrap">@translate(ATTEMPT)</th>
                                <th class="text-center whitespace-no-wrap">@translate(PROGRESS)</th>
                                <th class="text-center whitespace-no-wrap">@translate(DATA)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($proccessed as $proccess)
                                <tr class="intro-x">
                                    <td class="text-center">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="#{{ $proccess->job_id }}" class="rounded-full" width="40px" height="40px"
                                                src="{{ commonAvatar($proccess->job_id) }}" title="{{ $proccess->job_id }}">
                                        </div>
                                    </td>
                                    <td class="text-center " title="@translate(Queue Name)">
                                        {{ Str::after($proccess->name, 'App\Mail') }}</td>
                                    <td class="text-center " title="@translate(Queue Started At)">{{ $proccess->started_at }}
                                    </td>
                                    <td class="text-center " title="@translate(Queue Time Elapsed)">{{ $proccess->time_elapsed }}
                                    </td>
                                    <td class="text-center " title="@translate(Queue Attempt)">{{ $proccess->attempt }}</td>
                                    <td class="text-center " title="@translate(Queue Progress)">
                                        {{ $proccess->progress ?? '-' }}</td>
                                    <td class="text-center " title="@translate(Queue Data)">{{ $proccess->data ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7">
                                    <div class="text-center">
                                        @translate(Empty)
                                    </div>
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="intro-y col-span-12 text-center">
                    <div class="md:block mx-auto text-gray-600">Showing {{ $proccessed->firstItem() ?? '0' }} to
                        {{ $proccessed->lastItem() ?? '0' }} of {{ $proccessed->total() }} entries</div>
                </div>
                <!-- END: Data List -->
                <!-- BEGIN: Pagination -->
                {{ $proccessed->links('vendor.pagination.bootstrap-5') }}
                <!-- END: Pagination -->
            </div>
        </div>
    </div>
@endsection

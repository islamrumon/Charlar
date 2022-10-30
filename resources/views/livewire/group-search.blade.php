<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="card">
        <div class="card-header">
            <div class="messenger-tab search-tab app-scroll" data-view="search">
                <p class="messenger-title">Search</p>
                <input type="text" wire:model="search" class="form-control" placeholder="Search profiles" />
                <div class="search-records connectedSortable" id="sortable1">
                    <p class="message-hint center-el"><span>Type to search..</span></p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid user-card">
                <div class="row">
                    @foreach ($groups as $item)
                        <div class="col-md-6 col-lg-6 col-xl-4 box-col-4">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <img class="img-fluid" width="447px" height="279px"
                                        src="{{ filePath($item->cover) }}" alt="{{ $item->name }}">
                                </div>
                                <div class="card-profile"><img width="96px" height="96px" class="rounded-circle"
                                        src="{{ filePath($item->avatar) }}" alt="{{ $item->slug }}"></div>
                                <div class="text-center profile-details"><a href="javascript::void(0)">
                                        <h4>{{ $item->name }}</h4>
                                    </a>
                                    <h6>{{ $item->about }}</h6>
                                </div>
                                
                                <div class="card-footer row mt-2">
                                    <div class="col-4 col-sm-4">
                                        <h6>Created At</h6>
                                        <h3 class="counter">{{dateTimeFormat($item->created_at)}}</h3>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <h6>Group Admin</h6>
                                        @if($item->admin != null)
                                        <h3><span class="counter">{{$item->admin->name}}</span></h3>
                                        @endif
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <h6>Total Member</h6>
                                        <h3><span class="counter">{{$item->members->count()}}</span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $groups->links() }}

                </div>
            </div>
        </div>

    </div>
</div>

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
                    @foreach ($users as $user)
                        <div class="col-md-6 col-lg-6 col-xl-4 box-col-4">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <img class="img-fluid" width="447px" height="279px"
                                        src="{{ filePath($user->cover) }}" alt="{{ $user->slug }}">
                                </div>
                                <div class="card-profile"><img width="96px" height="96px" class="rounded-circle"
                                        src="{{ filePath($user->avatar) }}" alt="{{ $user->slug }}"></div>
                                <div class="text-center profile-details"><a href="javascript::void(0)">
                                        <h4>{{ $user->name }}</h4>
                                    </a>
                                    <h6>{{ $user->f_name }} {{ $user->l_name }} </h6>
                                    <h6>{{ $user->designation }}</h6>
                                </div>
                                <ul class="card-social">
                                    @if ($user->website != null)
                                        <li><a href="{{ $user->website }}" target="_blank">
                                                <img src="{{ filePath('internet.png') }}" width="24px" height="24px">
                                            </a></li>
                                    @endif
                                    @if ($user->facebook != null)
                                        <li><a href="{{ $user->facebook }}" target="_blank"><i
                                                    class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if ($user->whats_app != null)
                                        <li><a href="{{ $user->whats_app }}" target="_blank"><i
                                                    class="fa fa-whatsapp"></i></a>
                                        </li>
                                    @endif
                                    @if ($user->twiter != null)
                                        <li><a href="{{ $user->twiter }}" target="_blank"><i
                                                    class="fa fa-twitter"></i></a></li>
                                    @endif
                                    @if ($user->instragram != null)
                                        <li><a href="{{ $user->instragram }}" target="_blank"><i
                                                    class="fa fa-instagram"></i></a></li>
                                    @endif
                                    @if ($user->telegram != null)
                                        <li><a href="{{ $user->telegram }}" target="_blank">
                                                <img src="{{ filePath('telegram.png') }}" width="24px"
                                                    height="24px">
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="card-footer row d-none">
                                    <div class="col-4 col-sm-4">
                                        <h6>Follower</h6>
                                        <h3 class="counter">9564</h3>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <h6>Following</h6>
                                        <h3><span class="counter">49</span>K</h3>
                                    </div>
                                    <div class="col-4 col-sm-4">
                                        <h6>Total Post</h6>
                                        <h3><span class="counter">96</span>M</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $users->links() }}

                </div>
            </div>
        </div>

    </div>
</div>

<div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Add to group</h2>
                        <small>Whene user add is complete close the tab,
                            
                        </small>

                    </div>
                    <div class="card-body">
                        <input type="text" wire:model="search" class="form-control" placeholder="Search friends" />
                        {{-- ---------------- [ Search Tab ] ---------------- --}}
                        <div class="messenger-tab search-tab app-scroll" data-view="search">
                            {{-- items --}}
                            <p class="messenger-title">Search</p>
                            <div class="search-records connectedSortable" id="sortable1">
                                <p class="message-hint center-el"><span>Type to search..</span></p>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($records as $user)
                                <div class="col-md-6 col-lg-6 col-xl-4 box-col-4">
                                    {{-- <div class="page-header header-filter" data-parallax="true"
                                        style="background-image:url('{{ filePath($user->cover) }}');">
                                    </div> --}}
                                    <div class="profile">
                                        <div class="avatar">
                                            <img src="{{ filePath($user->avatar) }}" alt="Circle Image"
                                                class="img-raised rounded-circle img-fluid">
                                        </div>
                                        <div class="name">
                                            <h3 class="title">{{ $user->name }}</h3>
                                            <h6>{{ $user->f_name }} {{ $user->l_name }} </h6>
                                            <h6>{{ $user->designation }}</h6>
                                            <button  wire:click="addToGroup({{ $user->id }})"
                                                class="btn btn-success"><i class="fas fa-check"></i>Add to group</button>
                                             

                                                @if ($user->website != null)
                                                    <a href="{{ $user->website }}" target="_blank"
                                                        class="btn btn-just-icon btn-link ">
                                                        <img src="{{ filePath('internet.png') }}" width="24px"
                                                            height="24px">
                                                    </a>
                                                @endif

                                                @if ($user->facebook != null)
                                                    <a href="{{ $user->facebook }}" target="_blank"
                                                        class="btn btn-just-icon btn-link ">
                                                        <img src="{{ filePath('facebook.png') }}" width="24px"
                                                            height="24px">
                                                    </a>
                                                @endif

                                                @if ($user->twiter != null)
                                                    <a href="{{ $user->twiter }}" target="_blank"
                                                        class="btn btn-just-icon btn-link ">
                                                        <img src="{{ filePath('twitter.png') }}" width="24px"
                                                            height="24px">
                                                    </a>
                                                @endif
                                                @if ($user->instragram != null)
                                                    <a href="{{ $user->instragram }}" target="_blank"
                                                        class="btn btn-just-icon btn-link ">

                                                        <img src="{{ filePath('Instagram.png') }}" width="24px"
                                                            height="24px"></a>
                                                @endif

                                                @if ($user->whats_app != null)
                                                    <a href="{{ $user->whats_app }}" target="_blank"
                                                        class="btn btn-just-icon btn-link ">

                                                        <img src="{{ filePath('whatsapp.png') }}" width="24px"
                                                            height="24px">
                                                    </a>
                                                @endif

                                                @if ($user->telegram != null)
                                                    <a href="{{ $user->telegram }}" target="_blank"
                                                        class="btn btn-just-icon btn-link ">
                                                        <img src="{{ filePath('telegram.png') }}" width="24px"
                                                            height="24px">
                                                    </a>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Added Firends</h2>
                    </div>
                    <div class="card-body">
                        <ul id="sortable1" class="connectedSortable">
                            <li class="ui-state-default">Item 1</li>
                            <li class="ui-state-default">Item 2</li>
                            <li class="ui-state-default">Item 3</li>
                            <li class="ui-state-default">Item 4</li>
                            <li class="ui-state-default">Item 5</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

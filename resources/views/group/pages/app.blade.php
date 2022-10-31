@include('group.layouts.headLinks')
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span> </a>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="Search" />
            {{-- Tabs --}}
            <div class="messenger-listView-tabs">
                <a href="{{ route(config('chatify.routes.prefix')) }}">
                    <span class="far fa-user"></span> People</a>

                <a href="{{ route('group.messanger') }}" @if (Request::is('group/*')) class="active-tab" @endif
                    data-view="users">
                    <span class="fas fa-users"></span> Groups</a>
            </div>
        </div>
        {{-- tabs and lists --}}
        <div class="m-body contacts-container">
            {{-- Lists [Users/Group] --}}

            {{-- ---------------- [ Group Tab ] ---------------- --}}
            <div class="show messenger-tab groups-tab app-scroll" data-view="users">
                {{-- items --}}
                <input type="hidden" id="groupCreate" value="{{ route('group.create') }}">
                {{-- onclick="createGroup()" --}}
                <div class="g-create-div">
                    <button class="btn btn-light group-create-btn"
                        style="color:{{ $messengerColor }}; !importent">Create new group</button>
                </div>

                {!! view('group.layouts.listItem', ['get' => 'saved']) !!}
                {{-- Contact --}}
                <div class="listOfContactsGroup"></div>
            </div>

            {{-- ---------------- [ Search Tab ] ---------------- --}}
            <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title">Search</p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Type to search..</span></p>
                </div>
            </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}

        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar avatar-extra"
                        style="background-image: url({{ filePath($auth->avatar) }})">

                    </div>
                    <a href="#" class="user-name">{{ $auth->name }}</a>
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <input value="{{ route('group.send.call') }}" type="hidden" id="callingUrl">
                    
                    @if (getSystemSetting('video_call') == 'Yes')
                        <a href="#" class="video-call"><i class="fas fa-video"></i></a>
                    @endif

                    @if (getSystemSetting('video_call') == 'Yes')
                        <a href="#" class="audio-call"><i class="fas fa-phone"></i></a>
                    @endif

                    <a href="{{ route('group.messanger') }}"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
        </div>

        {{-- Internet connection --}}
        <div class="internet-connection">
            <span class="ic-connected">Connected</span>
            <span class="ic-connecting">Connecting...</span>
            <span class="ic-noInternet">No internet access</span>
        </div>
        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
            </div>
            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <p>
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </p>
                </div>
            </div>
            {{-- Send Message Form --}}
            @include('group.layouts.sendForm')
        </div>
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- nav actions --}}
        <nav>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        <div class="info-profile">
            {!! view('group.layouts.info')->render() !!}
        </div>
    </div>
</div>

@include('group.layouts.modals')
@include('group.layouts.footerLinks')

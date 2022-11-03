<!DOCTYPE html>
<html lang="htmlLang()">

<head>
    @include('layouts.include.head')
    <meta name="id" content="{{ $id }}">
    <meta name="type" content="{{ $type }}">
    <meta charset="UTF-8">
    <meta name="messenger-color" content="{{ $messengerColor }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('') . '/' . config('chatify.routes.prefix') }}"
        data-user="{{ Auth::user()->id }}">

    <title>{{ config('chatify.name') }}</title>
    @include('layouts.include.style')

    <link rel="stylesheet" href="{{ asset('agora_sdk/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}/assets/css/vendors/bootstrap.css">
</head>

<body>
    <input type="hidden" id="startCall" value="{{ route('group.start.call', routeValEncode($call->id)) }}">
    <input type="hidden" id="endCall" value="{{ route('group.end.call', routeValEncode($call->id)) }}">
    <div class="container-fluid">
        <div class="row">
            <div class="messenger-favorites app-scroll-thin"></div>
            <div class="col call-chat-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row chat-box">
                            <!-- Chat right side start-->
                            <div class="col pr-xl-0 chat-right-aside">
                                <!-- chat start-->
                                <div class="chat">

                                    <!-- chat-history start-->
                                    <div class="chat-history">
                                        <div class="row">
                                            @if ($call->end_at == null)
                                                @if ($call->start_at != null)
                                                    <div class="col text-center pe-0 call-content">
                                                        @if ($call->type == 'video_call')
                                                            <div class="row video-group">
                                                                <div class="col">
                                                                    <p id="local-player-name" class="player-name"></p>
                                                                    <div id="local-player" class="player"></div>
                                                                </div>
                                                                {{-- <div class="w-100"></div> --}}
                                                                <div class="col">
                                                                    <div id="remote-playerlist"></div>
                                                                </div>
                                                            </div>
                                                       
                                                        @endif
                                                        <div>
                                                            <div class="total-time">
                                                                <h2 class="digits">00:00</h2>
                                                            </div>
                                                            <div class="call-icons">
                                                                <ul class="list-inline d-none">
                                                                    <li class="list-inline-item"><a
                                                                            href="javascript:void(0)"><i
                                                                                class="icon-video-camera"></i></a></li>
                                                                    <li class="list-inline-item"><a
                                                                            href="javascript:void(0)"><i
                                                                                class="icon-volume"></i></a></li>
                                                                    <li class="list-inline-item"><a
                                                                            href="javascript:void(0)"><i
                                                                                class="icon-user"></i></a></li>
                                                                </ul>
                                                            </div>


                                                            <button class="btn btn-danger btn-block btn-lg endCall">END
                                                                CALL</button>


                                                            <div class="avatar-showcase">
                                                                <div class="customers d-inline-block avatar-group">
                                                                    <ul>
                                                                        @foreach ($gorupUsers as $user)
                                                                            <li class="d-inline-block"><img
                                                                                    class="img-70 rounded-circle"
                                                                                    src="{{ filePath($user->avatar) }}"
                                                                                    alt=""></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col text-center pe-0 call-content">
                                                        <div>
                                                            <div class="total-time">
                                                                <h2 class="digits">Connecting.....</h2>
                                                            </div>
                                                            @if ($call->host_id == $auth->id)
                                                                <button
                                                                    class="btn btn-danger btn-block btn-lg endCall">END
                                                                    CALL</button>
                                                            @elseif($auth->id == $call->to_id)
                                                                <button
                                                                    class="btn btn-success btn-block btn-lg acceptCall">Accept</button>
                                                                <button
                                                                    class="btn btn-danger btn-block btn-lg endCall">Reject</button>
                                                            @else
                                                                <button
                                                                    class="btn btn-danger btn-block btn-lg endCall">END
                                                                    CALL</button>
                                                            @endif

                                                            <div class="avatar-showcase">
                                                                <div class="customers d-inline-block avatar-group">
                                                                    <ul>
                                                                        @foreach ($gorupUsers as $user)
                                                                            <li class="d-inline-block"><img
                                                                                    class="img-70 rounded-circle"
                                                                                    src="{{ filePath($user->avatar) }}"
                                                                                    alt=""></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <h2>The call is end go to the <a
                                                        href="{{ route(config('chatify.routes.prefix')) }}"
                                                        class="nav-link">Home</a></h2>
                                            @endif

                                        </div>
                                    </div>
                                    <!-- chat-history ends-->
                                    <!-- chat end-->
                                    <!-- Chat right side ends-->
                                </div>
                            </div>

                        </div>
                        <!-- Container-fluid Ends-->
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('layouts.include.script')
    <script src="{{ asset('js/fuse.js') }}"></script>

    <!-- Pnotify js -->
    <script src="{{ asset('pnotify/js/pnotify.custom.js') }}"></script>
    <script src="{{ asset('pnotify/js/custom-pnotify.js') }}"></script>


    <script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher("{{ config('chatify.pusher.key') }}", {
            encrypted: true,
            cluster: "{{ config('chatify.pusher.options.cluster') }}",
            authEndpoint: '{{ route('pusher.auth') }}',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        });


        var appId = "{{ env('agora_app_id') }}";
        var minute = 0;
        var sec = 00;
        var show = false;

        //work with pusher

        var channel = pusher.subscribe("private-chatify");

        channel.bind("group-calling", function(data) {
            console.log("calling");
            console.log(data);
            console.log("calling end");
            if (data.channel == "{{ $call->channel }}" && {{ auth()->id() }} == data.to_id) {
                location.reload();
            }

        });


        @if ($call->start_at != null && $call->end_at == null)
            $(document).ready(function() {
                var token = '';
                @if ($call->host_id == $auth->id)
                    token = "{{ $call->group_token }}";
                @else
                    token = "{{ $call->to_token }}";
                @endif

                @if ($call->type == 'video_call')
                    joinVideoCall(appId, token, "{{ $call->channel }}", "{{ $auth->id }}");
                @else
                    joinACall(appId, token, "{{ $call->channel }}", "{{ $auth->id }}");
                @endif
                timeCounting();

            });
        @endif

        @if ($call->start_at == null && $call->end_at == null)
            $(document).ready(function() {
                rinning();
            });
        @endif




        function joinACall(appId, token, channel, uid) {
            joinAudioCall(appId, token, channel, uid);
        }

        function joinVideoCall(appId, token, channel, uid) {
            joinToRoom(appId, token, channel, uid);
        }

        function cancelAllCall() {
            leaveTheAudioCall();
            leave();
        }

        function rinning() {
            var audio = new Audio("{{ asset('simple_gamma.mp3') }}");
            audio.play();
        }

        $('.endCall').on('click', function() {
            cancelAllCall();
            endCall()

        });

        function endCall() {
            $.ajax({
                url: $('#endCall').val(),
                method: "GET",
                success: (data) => {

                },
                error: (error) => {
                    setContactsLoading(false);
                    console.error(error);
                },
            });
        }


        $('.acceptCall').on('click', function() {

            $.ajax({
                url: $('#startCall').val(),
                method: "GET",
                success: (data) => {

                },
                error: (error) => {
                    setContactsLoading(false);
                    console.error(error);
                },
            });
        });







        //time counting script


        function timeCounting() {
            minute = 0;
            sec = 00;
            show = true;
        }


        setInterval(function() {
            if (show) {
                $('.digits').empty();
                $('.digits').append(minute + " : " + sec);
            }

            @if ($call->start_at == null && $call->end_at == null)
                if (sec > 26) {
                    endCall();
                }
            @endif

            console.log(minute + " : " + sec)
            sec++;
            if (sec == 60) {
                minute++;
                sec = 00;
            }
        }, 1000);
    </script>
    <script src="{{ asset('agora_sdk/AgoraRTC_N-4.13.0.js') }}"></script>
    <script src="{{ asset('agora_sdk/index.js') }}"></script>
    <script src="{{ asset('agora_sdk/audio.js') }}"></script>
    @include('layouts.include.pnotify')
</body>


</html>

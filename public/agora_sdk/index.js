// create Agora client
var client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

var localTracks = {
    videoTrack: null,
    audioTrack: null,
};
var remoteUsers = {};
// Agora client options
var options = {
    appid: null,
    channel: null,
    uid: null,
    token: null,
};

//custom functions
async function joinToRoom(appid,token,channel,uid) {
    options.appid = appid;
    options.token = token;
    options.channel = channel;
    options.uid = uid;
    await join();
}


async function join() {
    // add event listener to play remote tracks when remote user publishs.

    client.on("user-published", handleUserPublished);
    client.on("user-unpublished", handleUserUnpublished);
    // localTracks.setVideoProfile('360p_8');

    // join a channel and create local tracks, we can use Promise.all to run them concurrently
    [options.uid, localTracks.audioTrack, localTracks.videoTrack] =
        await Promise.all([
            // join the channel
            client.join(
                options.appid,
                options.channel,
                options.token,
                options.uid
            ),

            // create local tracks, using microphone and camera

            AgoraRTC.createMicrophoneAudioTrack(),
            AgoraRTC.createCameraVideoTrack({
                // encoderConfig: "720p",
                encoderConfig: "480P_10",
            }),
        ]);

    // .setVideoProfile('360p_8');

    // play local video track
    localTracks.videoTrack.play("local-player");
    $("#local-player-name").text(`localVideo(${options.uid})`);

    // publish local tracks to channel
    await client.publish(Object.values(localTracks));
    console.log("publish success");
}

async function leave() {
    for (trackName in localTracks) {
        var track = localTracks[trackName];
        if (track) {
            track.stop();
            track.close();
            localTracks[trackName] = undefined;
        }
    }

    // remove remote users and player views
    remoteUsers = {};
    $("#remote-playerlist").html("");

    // leave the channel
    await client.leave();

    $("#local-player-name").text("");
}

async function subscribe(user, mediaType) {
    const uid = user.uid;
    // subscribe to a remote user
    await client.subscribe(user, mediaType);
    console.log("subscribe success");

    

    if (mediaType === "video") {
        // Get the RemoteVideoTrack object in the AgoraRTCRemoteUser object.
        const remoteVideoTrack = user.videoTrack;
        // Dynamically create a container in the form of a DIV element for playing the remote video track.
        const remotePlayerContainer = document.createElement("div");
        // Specify the ID of the DIV container. You can use the uid of the remote user.
        remotePlayerContainer.id = user.uid.toString();
        // remotePlayerContainer.textContent = "Remote user " + user.uid.toString();
        remotePlayerContainer.style.width = "640px";
        remotePlayerContainer.style.height = "480px";
        $("#remote-playerlist").append(remotePlayerContainer);

        // Play the remote video track.
        // Pass the DIV container and the SDK dynamically creates a player in the container for playing the remote video track.
        remoteVideoTrack.play(remotePlayerContainer);

        //old code in button
        //     const player = $(`<div id="player-wrapper-${uid}">
        //     <div id="player-${uid}" class="player"></div>
        //   </div>
        // `);
        //     $("#remote-playerlist").append(player);
        //     user.videoTrack.play(`player-${uid}`);
    }
    if (mediaType === "audio") {
        user.audioTrack.play();
    }
}

function handleUserPublished(user, mediaType) {
    console.log("handleUserPublished");
    console.log(mediaType);
    const id = user.uid;
    remoteUsers[id] = user;
    subscribe(user, mediaType);
}

function handleUserUnpublished(user) {
    console.log("handleUserUnpublished");
    const id = user.uid;
    delete remoteUsers[id];
    $(`#player-wrapper-${id}`).remove();
}

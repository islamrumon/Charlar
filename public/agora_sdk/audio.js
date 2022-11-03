let rtcAudio = {
    localAudioTrack: null,
    client: null,
};

let optionsAudio = {
    appId: null,
    channel: null,
    uid: null,
    token: null,
};
// async function joinAudioCall(appId,token,channel,uid) {
//     optionsAudio.appId = appId;
//     optionsAudio.token = token;
//     optionsAudio.channel = channel;
//     optionsAudio.uid = uid;
//     console.log(optionsAudio);
//     await startBasicCall();

//     // Join an RTC channel.
//     await rtcAudio.client.join(optionsAudio.appId, optionsAudio.channel, optionsAudio.token, optionsAudio.uid);
//     // Create a local audio track from the audio sampled by a microphone.
//     rtcAudio.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();

//     // Publish the local audio tracks to the RTC channel.
//     await rtcAudio.client.publish([rtcAudio.localAudioTrack]);

//     console.log("publish success!");
// }

async function joinAudioCall(appId, token, channel, uid) {
    optionsAudio.appId = appId;
    optionsAudio.token = token;
    optionsAudio.channel = channel;
    optionsAudio.uid = uid;
    console.log(optionsAudio);
    await startBasicCall();

    // Join an RTC channel.
    await rtcAudio.client.join(
        optionsAudio.appId,
        optionsAudio.channel,
        optionsAudio.token,
        optionsAudio.uid
    );
    // Create a local audio track from the audio sampled by a microphone.
    rtcAudio.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();

    //play the audio
    rtcAudio.localAudioTrack.play();
    alert(options.uid);
    $("#audio-local-player").append(options.uid);

    // Publish the local audio tracks to the RTC channel.
    await rtcAudio.client.publish([rtcAudio.localAudioTrack]);

    console.log("publish success!");
}

async function startBasicCall() {
    // Create an AgoraRTCClient object.
    rtcAudio.client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });
    // rtcAudio.client.audioVolume = 300;
    // rtcAudio.client
    // Listen for the "user-published" event, from which you can get an AgoraRTCRemoteUser object.
    rtcAudio.client.on("user-published", async (user, mediaType) => {
        // Subscribe to the remote user when the SDK triggers the "user-published" event
        await rtcAudio.client.subscribe(user, mediaType);
        console.log("subscribe success");

        // If the remote user publishes an audio track.
        if (mediaType === "audio") {
            // Get the RemoteAudioTrack object in the AgoraRTCRemoteUser object.
            const remoteAudioTrack = user.audioTrack;

            // Play the remote audio track.
            remoteAudioTrack.play();
            new PNotify({
                title: "Success notice",
                text: user.uid,
                type: "success",
            });
            // alert(user.uid);
            //here we get the attend user Uid
            // $("#audio-remote-playerlist").append(user.uid);
        }

        // Listen for the "user-unpublished" event
        rtcAudio.client.on("user-unpublished", async (user) => {
            // Unsubscribe from the tracks of the remote user.
            await rtcAudio.client.unsubscribe(user);
        });
    });
}

async function leaveTheAudioCall() {
    // Destroy the local audio track.
    rtcAudio.localAudioTrack.close();
    // Leave the channel.
    await rtcAudio.client.leave();
    console.log("client leaves channel success");
}

// startBasicCall()

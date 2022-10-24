<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\ChMessage as Message;
use App\Http\ChatifyMessenger as Chatify;
use App\Models\Calling;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yasser\Agora\RtcTokenBuilder;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CallingController extends Controller
{
    protected $perPage = 30;
    protected $messengerFallbackColor = '#2180f3';

    public  function getAgoraToken($user, $channelName, $publisher)
    {

        $appID = env('agora_app_id');
        $appCertificate = env('agora_app_certificate');
        $channelName = $channelName;
        $uid =  $user;
        if ($publisher) {
            $role = RtcTokenBuilder::RolePublisher;
        } else {
            $role = RtcTokenBuilder::RoleSubscriber;
            // $role = RtcTokenBuilder::RoleAttendee;
        }
        // $role = RtcTokenBuilder::RoleSubscriber;
        $expireTimeInSeconds = 86400;
        // $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
        $currentTimestamp = Carbon::now()->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
        return RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
    }








    public function sendcallingRequest(Request $request)
    {

        // default variables
        $error = (object)[
            'status' => 0,
            'message' => null
        ];
    


        if ($request['id'] != 0) {
            // if there is attachment [file]
            $messageID = mt_rand(9, 999999999) + time();
            $message = new Message();
            $message->id = $messageID;
            $message->type = $request['type'];
            $message->from_id = Auth::user()->id;
            $message->to_id = $request['id'];
            $message->body = htmlentities(trim($request['message']), ENT_QUOTES, 'UTF-8');
            $message->body = 'Call';
            $message->attachment = null;
            $message->message_type = $request['message_type'];
            $message->save();

            //calling data

            $calling = new Calling();
            $calling->type = $request->message_type;
            $calling->message_id = $messageID;
            $calling->from_id = $message->from_id; //auth user
            $calling->to_id = $message->to_id;
            $calling->channel = uniqid();
            $calling->from_token = $this->getAgoraToken($message->from_id, $calling->channel, true); //auth publisher
            $calling->to_token = $this->getAgoraToken($message->to_id, $calling->channel, false);
            $calling->save();

            // fetch message to send it with the response
            $messageData = Chatify::fetchMessage($messageID);

            $fromUser  = User::where('id', $message->from_id)->first();
            $isCalling = true;
            $call_type =  $calling->type;
            $calling_from_name = $fromUser->name;
            $calling_from_avatar = filePath($fromUser->avatar);
            $joinUrl = route('join.call', routeValEncode($calling->id));


            // send to user using pusher
            $chat = new Chatify();
            $chat->push('private-chatify', 'messaging', [
                'from_id' => Auth::user()->id,
                'to_id' => $request['id'],
                'calling' => true,
                'joinUrl' => $joinUrl,
                'call_type' => $call_type,
                'calling_from_name' => $calling_from_name,
                'calling_from_avatar' => $calling_from_avatar,
                'message' => Chatify::messageCard($messageData, 'default')
            ]);

            // send the response
            return Response::json([
                'status' => '200',
                'error' => $error,
                'calling' => true,
                'joinUrl' => $joinUrl,
                'callingId' => routeValEncode($calling->id),
                'call_type' => $call_type,
                'calling_from_name' => $calling_from_name,
                'calling_from_avatar' => $calling_from_avatar,
                'message' => Chatify::messageCard(@$messageData),
                'tempID' => $request['temporaryMsgId'],
            ]);
        } else {
            $error = (object)[
                'status' => 0,
                'message' => "You can't call your self"
            ];
        }

        return Response::json([
            'status' => '200',
            'error' => $error,
        ]);
    }


    public function joinCalling($id)
    {
        $call = Calling::where('id', routeValDecode($id))->first();
        if ($call->from_id != Auth::id()) {
            $fromUser = User::where('id', $call->from_id)->first();
        } else {
            $fromUser = User::where('id', $call->to_id)->first();
        }
        $auth = Auth::user();

        $routeName = FacadesRequest::route()->getName();
        $type = in_array($routeName, ['user', 'group'])
            ? $routeName
            : 'user';

        return view('calling.calling', [
            'call' => $call, 'fromUser' => $fromUser, 'auth' => $auth,
            'id' => $id ?? 0,
            'type' => $type ?? 'user',
            'messengerColor' => Auth::user()->messenger_color ?? $this->messengerFallbackColor,
            'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
        ]);
    }


    public function startCall($id)
    {
        $call = Calling::where('id', routeValDecode($id))->first();
        $call->start_at = Carbon::now();
        $call->save();

        $chat = new Chatify();
        $chat->push('private-chatify', 'calling', [
            'from_id' => $call->from_id,
            'to_id' => $call->to_id,
            'channel' => $call->channel,
            'message' => 'start_call',
        ]);

        //here send a pusher for connecting eachother
        return response()->json('call is started', 200);
    }

    public function endCall($id)
    {
        $call = Calling::where('id', routeValDecode($id))->first();
        $call->end_at = Carbon::now();
        $call->save();

        $chat = new Chatify();
        $chat->push('private-chatify', 'calling', [
            'from_id' => $call->from_id,
            'to_id' => $call->to_id,
            'channel' => $call->channel,
            'message' => 'end_call',
        ]);
        //here send a pusher for disconnecting each other
        return response()->json('call is end', 200);
    }





    public function joinRequest($id)
    {
        $call = Calling::where('id', routeValDecode($id))->first();
        return view('calling.calling', $call);
    }
}

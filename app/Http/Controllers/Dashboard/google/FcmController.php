<?php

namespace App\Http\Controllers\Dashboard\google;

use App\Http\Controllers\Controller;
use App\Models\DeviceKey;
use App\Models\PushNotifyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FcmController extends Controller
{
    //

    public function fcmIndex()
    {
        return view('dashboard.google.firebase');
    }


    public function fcmStore(Request $request)
    {
        overWriteEnvFile('apiKey', $request->apiKey);
        overWriteEnvFile('authDomain', $request->authDomain);
        overWriteEnvFile('projectId', $request->projectId);
        overWriteEnvFile('storageBucket', $request->storageBucket);
        overWriteEnvFile('messagingSenderId', $request->messagingSenderId);
        overWriteEnvFile('appId', $request->appId);
        overWriteEnvFile('measurementId', $request->measurementId);
        overWriteEnvFile('databaseURL', $request->databaseURL);


        return back()->with([
            'message' => translate('Firebase configration successfully updated'),
            'type' => 'success',
            'title' => translate('Success')
        ]);
    }

    //push notifecations
    public function googlePush()
    {
        return view('dashboard.google.push_notifications');
    }

    public function googlePushStore(Request $request)
    {

        setSystemSetting('push_notify_active', $request->push_notify_active);
        overWriteEnvFile('vapidKey', $request->vapidKey);
        overWriteEnvFile('serverKey', $request->serverKey);
        if ($request->hasFile('firebase_messaging_swp')) {
            fileUploadWithName($request->firebase_messaging_swp,  'firebase-messaging-swp');
        }
        return back()->with([
            'message' => translate('Push notifications configration successfully updated'),
            'type' => 'success',
            'title' => translate('Success')
        ]);
    }

    public function googlePushNotify()
    {
        return view('dashboard.google.notifications');
    }

    public function googlePushNotifyStore(Request $request)
    {

        $image = null;
        if ($request->hasFile('image')) {
            $image = fileUpload($request->image, 'push_notify', $request->title);
        }

        $deviceTokens = DeviceKey::whereNotNull('device_token')->pluck('device_token')->all();
        $log = new PushNotifyLog();
        $log->user_id = Auth::id();
        $log->title = $request->title;
        $log->body = $request->body;
        $log->image = $image;
        $log->tokens = count($deviceTokens);
        $log->save();
        $this->sendPushMessage($log->title, $log->body, $log->image, $deviceTokens);
        return back()->with([
            'message' => translate('Push Notifications send'),
            'type' => 'success',
            'title' => translate('Success')
        ]);
    }


    private function sendPushMessage($title, $message, $image, $deviceTokens)
    {

        if ($image == null) {
            $fields = array(
                "registration_ids" => $deviceTokens,
                'notification' => [
                    'title' => $title,
                    'body' => $message,
                ],
            );
        } else {
            $fields = array(
                "registration_ids" => $deviceTokens,
                'notification' => [
                    'title' => $title,
                    'body' => $message,
                    "image" => filePath($image),
                ],
            );
        }



        return $this->sendPushNotification($fields);
    }

    private function sendPushNotification($fields)
    {

        $url = 'https://fcm.googleapis.com/fcm/send';

        $server_key = env('serverKey');
        $headers = [
            'Authorization: Key=' . $server_key,
            'Content-Type: Application/json'
        ];
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === false) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        // return jso$ch;
        return $result;
    }

    public function googleNotifyLogs()
    {
        $logs = PushNotifyLog::latest()->get();
        return view('dashboard.google.notifyLog',compact('logs'));
    }

}

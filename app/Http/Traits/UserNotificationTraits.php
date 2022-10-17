<?php


namespace App\Http\Traits;


use App\Models\NotificationUser;
use App\Models\User;
use App\Notifications\InfoNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

trait UserNotificationTraits
{

    function getNotifications($take){
        if($take == 0){
            $notifications =  NotificationUser::where('target_user_id',Auth::id())
                ->where('target_user_id',0)->latest()->get();
        }else{
            $notifications =  NotificationUser::where('target_user_id',Auth::id())
                ->where('target_user_id',0)->latest()->get()->take($take);
        }

       return $notifications;
    }

    function readNotifications($id){
        $notify  =NotificationUser::where('id',$id)->first();
        if($notify != null){
            $notify->is_read = true;
            $notify->save();
        }
    }

    function userNotifications(
        $form_user_id,
        $target_user_id,
        $title,
        $message,
        $type,
        $alert,
        $topic)
    {
        $notify = new NotificationUser();
        $notify->form_user_id = $form_user_id;
        $notify->target_user_id = $target_user_id;
        $notify->title = $title;
        $notify->message = $message;
        $notify->type = $type;
        $notify->alert = $alert;
        $notify->topic = $topic;
        $notify->save();
//        $this->sendTheMail($notify);

        $type = array('store-update',
            'new-store',
            'post-deleted',
            'new-ads',
            'password-updated',
            'language-changed',
            'user-profile-update',
            'new-ads',
            'ads-update',
            'ads-destroy',
            'balance-low',
            'contact-message-status',
            'store-status',
            'wallet-status',
            'post-status',
            'post-limit',
            'ads-approved',
            'user-register',
            'ads-limit');
        $topic = array('for-admin', 'for-user-id');

        /*here user type for message to mail */
        /*can user s-case for send mail*/
    }


    function sendTheMail(NotificationUser $notificationUser)
    {
        if ($notificationUser->topic == 'for-admin') {
            /*send all mail in admin group*/
        } else {

            $this->sendPushMessage($notificationUser->title,
                $notificationUser->message,
                $notificationUser->topic,
                $notificationUser->target_user_id);

            try {
                $user = User::where('id', $notificationUser->target_user_id)->first();
                if ($user != null) {
                    $user->notify(new InfoNotification($notificationUser->title, $notificationUser->message));
                }
            }catch (\Exception $exception){}

        }
    }


    public function sendPushMessage($title, $message, $topic, $userId)
    {
        $fields = array(
            'to' => '/topics/' . $topic,
            'notification' => [
                'title' => $title,
                'body' => $message
            ],
            'data' => array(
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'id' => '1',
                'status' => 'done',
                'user_id' => $userId,
            ),
        );

        return $this->sendPushNotification($fields);
    }

    private function sendPushNotification($fields)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $server_key = "AAAALwsArAY:APA91bH9S-LzYwN9LkSj-4_TYw4aB653o0oVUSaiLkqyHHz3vyZHz6zGU6f6VnfNbmgLGzUq-gJdOSbNpdMhOrXI5LNYxaZJ6O46GuiCC8vUSXjkUoPGUzJgnUT1TejZNACXtS6Jzamq	";
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

        return $result;
    }
}

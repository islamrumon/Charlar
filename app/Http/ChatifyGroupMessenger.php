<?php

namespace App\Http;

use App\Models\Calling;

use App\Models\GroupMessage;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\File;
use Junges\ACL\Contracts\Group;

class ChatifyGroupMessenger
{
    public $pusher;

    /**
     * Get max file's upload size in MB.
     *
     * @return int
     */
    public static function  getMaxUploadSize()
    {
        return config('chatify.attachments.max_upload_size') * 1048576;
    }

    public function __construct()
    {
        $this->pusher = new Pusher(
            config('chatify.pusher.key'),
            config('chatify.pusher.secret'),
            config('chatify.pusher.app_id'),
            config('chatify.pusher.options'),
        );
    }
    /**
     * This method returns the allowed image extensions
     * to attach with the message.
     *
     * @return array
     */
    public static function getAllowedImages()
    {
        return config('chatify.attachments.allowed_images');
    }

    /**
     * This method returns the allowed file extensions
     * to attach with the message.
     *
     * @return array
     */
    public static function getAllowedFiles()
    {
        return config('chatify.attachments.allowed_files');
    }

    /**
     * Returns an array contains messenger's colors
     *
     * @return array
     */
    public static function getMessengerColors()
    {
        return config('chatify.colors');
    }

    /**
     * Trigger an event using Pusher
     *
     * @param string $channel
     * @param string $event
     * @param array $data
     * @return void
     */
    public  function push($channel, $event, $data)
    {
        return $this->pusher->trigger($channel, $event, $data);
    }

    /**
     * Authentication for pusher
     *
     * @param string $channelName
     * @param string $socket_id
     * @param array $data
     * @return void
     */
    public  function pusherAuth($channelName, $socket_id, $data = null)
    {
        return $this->pusher->socket_auth($channelName, $socket_id, $data);
    }

    /**
     * Fetch message by id and return the message card
     * view as a response.
     *
     * @param int $id
     * @return array
     */
    public static function fetchMessage($id, $index = null)
    {
        $attachment = null;
        $attachment_type = null;
        $attachment_title = null;

        $msg = GroupMessage::where('id', $id)->first();
        if (!$msg) {
            return [];
        }

        if (isset($msg->attachment)) {
            $attachmentOBJ = json_decode($msg->attachment);
            $attachment =  $attachmentOBJ->new_name;
            $attachment_title = htmlentities(trim($attachmentOBJ->old_name), ENT_QUOTES, 'UTF-8');

            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            $attachment_type = in_array($ext, self::getAllowedImages()) ? 'image' : 'file';
        }

        return [
            'index' => $index,
            'id' => $msg->id,
            'from_avatar' => $msg->from->avatar,
            'from_name' => $msg->from->name,
            'from_id' => $msg->from_id,
            'group_id' => $msg->group_id,
            'message' => $msg->body,
            'attachment' => [$attachment, $attachment_title, $attachment_type],
            'time' => $msg->created_at->diffForHumans(),
            'fullTime' => $msg->created_at,
            'viewType' => ($msg->from_id == Auth::user()->id) ? 'sender' : 'default',
            'seen' => $msg->seen,
        ];
    }

    /**
     * Return a message card with the given data.
     *
     * @param array $data
     * @param string $viewType
     * @return string
     */
    public static function messageCard($data, $viewType = null)
    {
        if (!$data) {
            return '';
        }
        $data['viewType'] = ($viewType) ? $viewType : $data['viewType'];
        return view('group.layouts.messageCard', $data)->render();
    }

    /**
     * Default fetch messages query between a Sender and Receiver.
     *
     * @param int $user_id
     * @return Message|\Illuminate\Database\Eloquent\Builder
     */
    public static function fetchMessagesQuery($group_id)
    {
        return GroupMessage::where('group_id', $group_id);
    }

    /**
     * create a new message to database
     *
     * @param array $data
     * @return void
     */
    public static function newMessage($data)
    {
        $message = new GroupMessage();
        $message->id = $data['id'];
        $message->type = $data['type'];
        $message->from_id = $data['from_id'];
        $message->group_id = $data['group_id'];
        $message->body = $data['body'];
        $message->attachment = $data['attachment'];
        $message->message_type = $data['message_type'];
        $message->save();

        // call details save on condition here
    }

    /**
     * Make messages between the sender [Auth user] and
     * the receiver [User id] as seen.
     *
     * @param int $user_id
     * @return bool
     */
    public static function makeSeen($group_id)
    {
        GroupMessage::Where('group_id', $group_id)
            ->where('seen', 0)
            ->update(['seen' => 1]);
        return 1;
    }

    /**
     * Get last message for a specific user
     *
     * @param int $user_id
     * @return Message|Collection|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function getLastMessageQuery($group_id)
    {
        return self::fetchMessagesQuery($group_id)->latest()->first();
    }

    /**
     * Count Unseen messages
     *
     * @param int $user_id
     * @return Collection
     */
    public  static function countUnseenMessages($group_id)
    {
        return GroupMessage::where('group_id', $group_id)->where('seen', 0)->count();
    }

    /**
     * Get user list's item data [Contact Itme]
     * (e.g. User data, Last message, Unseen Counter...)
     *
     * @param int $messenger_id
     * @param Collection $user
     * @return string
     */
    public static function getContactItem($group)
    {
        // get last message
        $lastMessage = self::getLastMessageQuery($group->id);

        // Get Unseen messages counter
        $unseenCounter = self::countUnseenMessages($group->id);

        return view('group.layouts.listItem', [
            'get' => 'users',
            'user' => self::getUserWithAvatar($group),
            'lastMessage' => $lastMessage,
            'unseenCounter' => $unseenCounter,
        ])->render();
    }



    /**
     * Get user with avatar (formatted).
     *
     * @param Collection $user
     * @return Collection
     */
    public static function getUserWithAvatar($group)
    {
        $group->avatar = filePath($group->avatar);
        return  $group;
        if ($group->avatar == 'avatar.png' && config('chatify.gravatar.enabled')) {
            $imageSize = config('chatify.gravatar.image_size');
            $imageset = config('chatify.gravatar.imageset');
            $group->avatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($group->email))) . '?s=' . $imageSize . '&d=' . $imageset;
        } else {
            $group->avatar = self::getUserAvatarUrl($group->avatar);
        }
        return $group;
    }

    /**
     * Check if a user in the favorite list
     *
     * @param int $user_id
     * @return boolean
     */
    public static function inFavorite($user_id)
    {
        return true;
    }

    /**
     * Make user in favorite list
     *
     * @param int $user_id
     * @param int $star
     * @return boolean
     */
    public static function makeInFavorite($user_id, $action)
    {
        return true;
       
    }

    /**
     * Get shared photos of the conversation
     *
     * @param int $user_id
     * @return array
     */
    public static function getSharedPhotos($user_id)
    {
        $images = array(); // Default
        // Get messages
        $msgs = self::fetchMessagesQuery($user_id)->orderBy('created_at', 'DESC');
        if ($msgs->count() > 0) {
            foreach ($msgs->get() as $msg) {
                // If message has attachment
                if ($msg->attachment) {
                    $attachment = json_decode($msg->attachment);
                    // determine the type of the attachment
                    in_array(pathinfo($attachment->new_name, PATHINFO_EXTENSION), self::getAllowedImages())
                        ? array_push($images, $attachment->new_name) : '';
                }
            }
        }
        return $images;
    }

    /**
     * Delete Conversation
     *
     * @param int $user_id
     * @return boolean
     */
    public static function deleteConversation($user_id)
    {
        try {
            foreach (self::fetchMessagesQuery($user_id)->get() as $msg) {
                // delete file attached if exist
                if (isset($msg->attachment)) {
                    $path = json_decode($msg->attachment)->new_name;
                    fileDelete($path);
                }
                // delete from database
                $msg->delete();
            }
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Delete message by ID
     *
     * @param int $id
     * @return boolean
     */
    public static function deleteMessage($id)
    {
        try {
            $msg = GroupMessage::findOrFail($id);
            if ($msg->from_id == auth()->id()) {
                // delete file attached if exist
                if (isset($msg->attachment)) {
                    $path = config('chatify.attachments.folder') . '/' . json_decode($msg->attachment)->new_name;
                    if (self::storage()->exists($path)) {
                        self::storage()->delete($path);
                    }
                }
                // delete from database
                $msg->delete();
            } else {
                return 0;
            }
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
    // {"new_name":"09ee0ce4-aa22-4eb7-af29-94eb951dcfb7.png","old_name":"welcome to login.png"}

    /**
     * Return a storage instance with disk name specified in the config.
     *
     */
    public static function storage()
    {
        return Storage::disk(config('chatify.storage_disk_name'));
    }

    /**
     * Get user avatar url.
     *
     * @param string $user_avatar_name
     * @return string
     */
    public function getUserAvatarUrl($user_avatar_name)
    {
        // return self::storage()->url(config('chatify.user_avatar.folder') . '/' . $user_avatar_name);
        return filePath($user_avatar_name);
    }

    /**
     * Get attachment's url.
     *
     * @param string $attachment_name
     * @return string
     */
    public static function getAttachmentUrl($attachment_name)
    {
        return filePath($attachment_name);
        // return self::storage()->url(config('chatify.attachments.folder') . '/' . $attachment_name);
    }


    //group code
    public static function getGroupContactItem($user)
    {
        //kaj baki ase message query and  unseend ar ta
        // get last message
        $lastMessage = self::getLastMessageQuery($user->id);

        // Get Unseen messages counter
        $unseenCounter = self::countUnseenMessages($user->id);

        return view('group.layouts.listItem', [
            'get' => 'users',
            'user' => self::getUserWithAvatar($user),
            'lastMessage' => $lastMessage,
            'unseenCounter' => $unseenCounter,
        ])->render();
    }
}

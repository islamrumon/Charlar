<?php

namespace App\Http\Controllers;

use App\Http\ChatifyMessenger;
use App\Models\ChFavorite;
use App\Models\GroupChat;
use App\Models\GroupParticipant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Support\Facades\Response;

class GroupChatingController extends Controller
{
    //

    public function create($id = null)
    {

        return view('group.create', [
            'auth' => Auth::user(),
            'id' => $id ?? 0,
            'type' => 'group',
            'messengerColor' => Auth::user()->messenger_color ?? $this->messengerFallbackColor,
            'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);

        $auth = Auth::user();
        $group = new GroupChat();
        $group->name = $request->name;
        $group->type = $request->type;
        $group->code = Str::slug($request->name) . rendomForDigite();
        $group->about = $request->about;
        $group->admin_id = $auth->id;
        $group->avatar = fileUpload($request->avatar, 'groups', $request->name);
        $group->cover = fileUpload($request->cover, 'groups_cover', $request->name);
        $group->save();

        $participant = new GroupParticipant();
        $participant->group_id = $group->id;
        $participant->user_id = $auth->id;
        $participant->save();

        $url = route('group.messanger').'/'.$group->id;
        return redirect()->to($url);
    }

    public function addUser($id)
    {
        $groupId = $id;
        $id = 0;
        $type = 'group';
        $messengerColor = Auth::user()->messenger_color ?? $this->messengerFallbackColor;
        $dark_mode = Auth::user()->dark_mode < 1 ? 'light' : 'dark';
        return view('group.add_users', compact('groupId',  'id', 'type', 'messengerColor', 'dark_mode'));
    }

     // searchUser

     public function searchUser(Request $request)
     {
         $groupUsers = GroupParticipant::where('group_id',$request->group_id)->pluck('user_id');
         
         $records = User::whereNotIn('id',$groupUsers)
         ->where('name', 'LIKE', "%{$request->key}%")
         ->where('email', 'LIKE', "%{$request->key}%")
         ->get();

         $id = $request->group_id;
         $views = view('group.layouts.user_search',compact('records','id'))->render();

         return response()->json(['view'=>$views],200);
     }


    public function addUserGroup(Request $request)
    {
        $add = new GroupParticipant();
        $add->group_id = $request->group_id;
        $add->user_id = $request->user_id;
        $add->save();
        return response()->json(['message'=>'Done'],200);
    }


    public function search(Request $request)
    {
        $getRecords = null;
        $input = trim(filter_var($request['input']));
        $records = User::where('id', '!=', Auth::user()->id)
            ->where('name', 'LIKE', "%{$input}%")
            ->where('email', 'LIKE', "%{$input}%")
            ->paginate($request->per_page ?? $this->perPage);
        foreach ($records->items() as $record) {
            $getRecords .= view('messanger.layouts.listItem', [
                'get' => 'search_item',
                'type' => 'user',
                'user' => ChatifyMessenger::getUserWithAvatar($record),
            ])->render();
        }
        if ($records->total() < 1) {
            $getRecords = '<p class="message-hint center-el"><span>Nothing to show.</span></p>';
        }
        // send the response
        return Response::json([
            'records' => $getRecords,
            'total' => $records->total(),
            'last_page' => $records->lastPage()
        ], 200);
    }

    public function removeFormGroup($id,$userId)
    {
        
        $group = GroupParticipant::where('group_id',$id)->where('user_id',$userId)->first();
        if($group){
            $group->delete();
        } 
        return response()->json(['id'=>$userId],200);
    }
}

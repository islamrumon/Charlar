<?php

namespace App\Http\Controllers;

use App\Http\ChatifyMessenger;
use App\Models\GroupChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Support\Facades\Response;

class GroupChatingController extends Controller
{
    //
    
    public function create()
    {
        return view('messanger.group.create',[
            'auth' => Auth::user(),
            'id' => $id ?? 0,
            'type' => $type ?? 'user',
            'messengerColor' => Auth::user()->messenger_color ?? $this->messengerFallbackColor,
            'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $group = new GroupChat();
        $group->name = $request->name;
        $group->code = Str::slug($request->name).rendomForDigite();
        $group->about = $request->about;
        $group->admin_id = Auth::id();
        $group->avatar = fileUpload($request->avatar,'groups',$request->name);
        $group->cover = fileUpload($request->cover,'groups_cover',$request->name);
        $group->save();

        //send own love 

        return view('messanger.group.add_users');
    }


    public function addUsers(Request $request)
    {
        return $request;
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
}

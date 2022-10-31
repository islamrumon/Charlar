<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  


    public function profileUpdate(Request $request)
    {
        // return $request;
        $id = routeValDecode($request->id);
        if ($id == Auth::id()) {
            //update the profile 
            $user = User::where('id', $id)->first();
            $user->f_name = $request->f_name;
            $user->l_name = $request->l_name;
            $user->instragram = $request->instragram;
            $user->bio = $request->bio;
            $user->designation = $request->designation;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->website = $request->website;
            $user->facebook = $request->facebook;
            $user->twiter = $request->twiter;
            $user->whats_app = $request->whats_app;
            $user->telegram = $request->telegram;
            if ($request->hasFile('avatar')) {
                $user->avatar = fileUpload($request->avatar, 'users', $user->name);
            }
            if ($request->hasFile('cover')) {
                $user->cover = fileUpload($request->cover, 'cover', $user->name);
            }
            $user->save();

            return back()->with(['message' => translate('Profile is updatede successfully'), 'type' => 'success', 'title' => translate('Success')]);
        } else {
            return back()->with(['message' => translate('There have some problem '), 'type' => 'error', 'title' => translate('Success')]);
        }
    }

    public function usersProfile()
    {
        //liveware show
        return view('dashboard.home.profiles');
    }

    public function chatGroups()
    {
        //liveware show
        return view('dashboard.home.chatGroup');
    }

   


}

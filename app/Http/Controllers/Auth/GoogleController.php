<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PlaneAssign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function loginUsing()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFrom()
    {
        try {
            $user = Socialite::driver('google')->user();

            $userIsExist = User::where('email', $user->getEmail())->first();
            if ($userIsExist) {
                $userIsExist->provider_id = $user->getId();
                $userIsExist->provider = 'google';
                $userIsExist->save();
                Auth::loginUsingId($userIsExist->id);
            } else {
                $slug = Str::slug($user->getName());
                $users = User::where('slug', $slug)->count();
                if ($users > 0) {
                    $slug .= rendomForDigite();
                }
                $saveUser = new User();
                $user->name = $user->getName();
                $user->email = $user->getEmail();
                $user->slug =  $slug;
                $user->type =  'member';
                $user->password = Hash::make(Str::random(10));
                $user->save();
                //assign default plane
                $assign = new PlaneAssign();
                $assign->plane_id = getSystemSetting('default_plane');
                $assign->user_id = $user->id;
                $assign->payment_type = 'free';
                $assign->pay_able_amount = 00;
                $assign->pay_amount = 00;
                $assign->approved_by = $user->id;
                $assign->is_paid = true;
                $assign->is_active = true;
                $assign->save();
            }


            return redirect()->route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

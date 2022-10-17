<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated(Request $request, $user)
    {
        //its work properly
        //now any time can wee add conditions


        if (true) {
            // $id = $user->id;
            if ($user->banned == true) {
                auth()->logout();
                return back()->with(['message' => translate('You are banned By The Administration, Please Contact with administration'), 'type' => 'info', 'title' => translate('Information')]);
            }

            if (getSystemSetting('verification') == "on" && !$user->email_verified_at) {
                auth()->logout();
                return view('auth.verify', compact('id'));
            }

            /*store login time*/
            $user->login_time = Carbon::now();
            $user->save();
        }
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.social.index');
    }


    function facebookStore(Request $request)
    {
        setSystemSetting('facebook_login_status',$request->facebook_login_status);
        overWriteEnvFile('facebook_client_id',$request->facebook_client_id);
        overWriteEnvFile('facebook_client_secret',$request->facebook_client_secret);
        overWriteEnvFile('facebook_redirect',$request->facebook_redirect);
        return back()->with(['message' => translate('Facebook login updated'), 'type' => 'success', 'title' => translate('Updated')]);
    }


    function googleStore(Request $request)
    {
        setSystemSetting('google_login_status',$request->google_login_status);
        overWriteEnvFile('google_client_id',$request->google_client_id);
        overWriteEnvFile('google_client_secret',$request->google_client_secret);
        overWriteEnvFile('google_redirect',$request->google_redirect);
        return back()->with(['message' => translate('Google login updated'), 'type' => 'success', 'title' => translate('Updated')]);
    }
}

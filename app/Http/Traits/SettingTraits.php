<?php


namespace App\Http\Traits;


use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

trait SettingTraits
{
    //smtp View
    public function smtpCreate()
    {

        return view('dashboard.common.setting.smtp.smtp');
    }

    //there are store the smtp setting get all request,
    // data and overWrite in overWriteEnvFile() in .env file
    public function smtpStore(Request $request)
    {
        foreach ($request->types as $key => $type) {
            overWriteEnvFile($type, $request[$type]);
        }
        return back()->with(['message' => translate('Mail setup  successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }


    /*All site setting here*/
    public function siteSetting()
    {
        return view('dashboard.common.setting.siteSetting');
    }

    /*update the site setting*/
    /*update the site setting*/
    public  function siteSettingUpdate(Request $request)
    {

        // return $request;
        if ($request->hasFile('type_logo')) {
            $logo = fileUpload($request->type_logo, 'site', 'type_logo');
            setSystemSetting('type_logo', $logo);
        }
        if ($request->hasFile('favicon_icon')) {
            $f_icon = fileUpload($request->favicon_icon, 'site', 'favicon_icon');
            setSystemSetting('favicon_icon', $f_icon);
        }

        if ($request->hasFile('footer_logo')) {
            $f_logo = fileUpload($request->footer_logo, 'site', 'footer_logo');
            setSystemSetting('footer_logo', $f_logo);
        }
        if ($request->has('type_name')) {

            setSystemSetting('type_name', $request->type_name);
        }
        if ($request->has('type_footer')) {
            setSystemSetting('type_footer', $request->type_footer);
        }
        if ($request->has('type_fb')) {
            setSystemSetting('type_fb', $request->type_fb);
        }
        if ($request->has('type_tw')) {
            setSystemSetting('type_tw', $request->type_tw);
        }
        if ($request->has('type_google')) {
            setSystemSetting('type_google', $request->type_google);
        }
        if ($request->has('type_address')) {
            setSystemSetting('type_address', $request->type_address);
        }
        if ($request->has('type_number')) {
            setSystemSetting('type_number', $request->type_number);
        }
        if ($request->has('type_mail')) {
            setSystemSetting('type_mail', $request->type_mail);
        }

        if ($request->has('type_linkedin')) {
            setSystemSetting('type_linkedin', $request->type_linkedin);
        }
        if ($request->has('type_pinterest')) {
            setSystemSetting('type_pinterest', $request->type_pinterest);
        }

        if ($request->has('type_pinterest')) {
            setSystemSetting('type_pinterest', $request->type_pinterest);
        }
        if ($request->has('type_instagram')) {
            setSystemSetting('type_instagram', $request->type_instagram);
        }

        return back()->with(['message' => translate('Site setting is done'), 'type' => 'success', 'title' => translate('Success')]);
    }


    public function systemSetting()
    {
        return view('dashboard.common.setting.systemSetting');
    }

    public function systemSettingUpdate(Request $request)
    {

        if ($request->has('multi_lang')) {
            setSystemSetting('multi_lang', $request->multi_lang);
        }

        if ($request->has('video_call')) {
            setSystemSetting('video_call', $request->video_call);
        }

        if ($request->has('voice_call')) {
            setSystemSetting('voice_call', $request->voice_call);
        }
        return back()->with(['message' => translate('Apps setting is done'), 'type' => 'success', 'title' => translate('Success')]);
    }
}

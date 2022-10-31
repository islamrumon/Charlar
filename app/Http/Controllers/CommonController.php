<?php

namespace App\Http\Controllers;

use App\Http\Traits\CategoriesTraits;
use App\Http\Traits\CurrencyTraits;
use App\Http\Traits\GroupPermissionTraits;
use App\Http\Traits\LanguageTraits;
use App\Http\Traits\PagesTraits;
use App\Http\Traits\SettingTraits;
use App\Http\Traits\SliderTrait;
use App\Models\User;
use App\Notifications\ResetPasswordWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\Page;
use App\Models\PageGroup;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;

class CommonController extends Controller
{
    use GroupPermissionTraits, SliderTrait, LanguageTraits, CurrencyTraits, SettingTraits, PagesTraits, CategoriesTraits;


    public function tips()
    {
        return view('dashboard.common.safety_tips');
    }

    public static function topMenu()
    {
        return  \App\Models\Menus::where('id', 1)->with('items')->first();
    }


    public function links()
    {
        $pages = Page::Active()->get();
        $posts = BlogPost::where('is_published', true)->get();
        return view('dashboard.links', compact('pages', 'posts'));
    }




    public function seoSetup()
    {
        return view('dashboard.common.setting.seo');
    }

    public function contactMessages()
    {
        $contacts = Contact::latest()->get();
        return view('dashboard.contactMessages', compact('contacts'));
    }

    public function appSdkCreate()
    {
        return view('dashboard.sdk');
    }

    public function appSdkStore(Request $request)
    {
        overWriteEnvFile('agora_app_id',$request->agora_app_id);
        overWriteEnvFile('agora_app_certificate',$request->agora_app_certificate);
        return back()->with(['message' => translate('Agora sdk configuration is  updated'), 'type' => 'success', 'title' => translate('Updated')]);
    }


    public function pusherSdkCreate()
    {
        return view('dashboard.pusher');
    }

    public function pusherSdkStore(Request $request)
    {
        overWriteEnvFile('PUSHER_APP_ID',$request->PUSHER_APP_ID);
        overWriteEnvFile('PUSHER_APP_KEY',$request->PUSHER_APP_KEY);
        overWriteEnvFile('PUSHER_APP_SECRET',$request->PUSHER_APP_SECRET);
        overWriteEnvFile('PUSHER_HOST',$request->PUSHER_HOST);
        overWriteEnvFile('PUSHER_PORT',$request->PUSHER_PORT);
        overWriteEnvFile('PUSHER_SCHEME',$request->PUSHER_SCHEME);
        overWriteEnvFile('PUSHER_APP_CLUSTER',$request->PUSHER_APP_CLUSTER);
        return back()->with(['message' => translate('Pusher sdk configuration is updated'), 'type' => 'success', 'title' => translate('Updated')]);
    }

    public function seoUpdate(Request $request)
    {

        if ($request->has('meta_keys')) {
            setSystemSetting('meta_keys', $request->meta_keys);
        }

        if ($request->has('meta_title')) {
            setSystemSetting('meta_title', $request->meta_title);
        }


        if ($request->has('meta_desc')) {
            setSystemSetting('meta_desc', $request->meta_desc);
        }




        return back()->with([
            'message' => translate('SEO Setup successfull'),
            'type' => 'success',
            'title' => translate('Success')
        ]);;
    }




    public function clearCash()
    {
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        App::setLocale(env('DEFAULT_LANGUAGE'));
        return back();
    }


    public function changePassword()
    {
        return view('dashboard.common.setting.passwordChange');
    }

    public function changeUpdate(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword()],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('dashboard')->with([
            'message' => translate('Your Password is changed'),
            'type' => 'success',
            'title' => translate('Success')
        ]);
    }

    public function systemSetting()
    {
        return view('dashboard.common.setting.systemSetting');
    }

    public function systemSettingSetup(Request $request)
    {
        if ($request->has('slider_title')) {
            setSystemSetting('slider_title', $request->slider_title);
        }

        if ($request->has('slider_sub_title')) {
            setSystemSetting('slider_sub_title', $request->slider_sub_title);
        }

        if ($request->has('featured_title')) {
            setSystemSetting('featured_title', $request->featured_title);
        }

        if ($request->has('featured_sub_title')) {
            setSystemSetting('featured_sub_title', $request->featured_sub_title);
        }

        if ($request->has('recommend_title')) {
            setSystemSetting('recommend_title', $request->recommend_title);
        }

        if ($request->has('recommend_sub_title')) {
            setSystemSetting('recommend_sub_title', $request->recommend_sub_title);
        }

        if ($request->has('trending_title')) {
            setSystemSetting('trending_title', $request->trending_title);
        }

        if ($request->has('trending_sub_title')) {
            setSystemSetting('trending_sub_title', $request->trending_sub_title);
        }

        if ($request->has('top_title')) {
            setSystemSetting('top_title', $request->top_title);
        }

        if ($request->has('top_sub_title')) {
            setSystemSetting('top_sub_title', $request->top_sub_title);
        }
        if ($request->has('city_title')) {
            setSystemSetting('city_title', $request->city_title);
        }
        if ($request->has('city_sub_title')) {
            setSystemSetting('city_sub_title', $request->city_sub_title);
        }
        if ($request->has('slider_sub_title')) {
            setSystemSetting('slider_sub_title', $request->slider_sub_title);
        }
        if ($request->has('advertise_title')) {
            setSystemSetting('advertise_title', $request->advertise_title);
        }
        if ($request->has('advertise_title')) {
            setSystemSetting('advertise_title', $request->advertise_title);
        }

        if ($request->has('advertise_sub_title')) {
            setSystemSetting('advertise_sub_title', $request->advertise_sub_title);
        }
        if ($request->has('plane_title')) {
            setSystemSetting('plane_title', $request->plane_title);
        }
        if ($request->has('plane_sub_title')) {
            setSystemSetting('plane_sub_title', $request->plane_sub_title);
        }

        if ($request->has('dashboard_text')) {
            setSystemSetting('dashboard_text', $request->dashboard_text);
        }

        if ($request->hasFile('dashboard_image')) {
            $image = fileUpload($request->dashboard_image, 'ads', '');
            setSystemSetting('dashboard_image', $image);
        }

        return back()->with([
            'message' => translate('Home page static contend successfully updated'),
            'type' => 'success',
            'title' => translate('Success')
        ]);
    }

    public function othersPageStaticContentForm()
    {
        return view('dashboard.common.page.others');
    }
    public function othersPage(Request $request)
    {
        if ($request->has('slider_title')) {
            setSystemSetting('slider_title', $request->slider_title);
        }
        if ($request->has('slider_btn')) {
            setSystemSetting('slider_btn', $request->slider_btn);
        }
        if ($request->has('slider_sub_title')) {
            setSystemSetting('slider_sub_title', $request->slider_sub_title);
        }
        if ($request->hasFile('slider_right_image')) {
            $image = fileUpload($request->slider_right_image, 'landing', '');
            setSystemSetting('slider_right_image', $image);
        }
        //slider section


        if ($request->has('about_1_title')) {
            setSystemSetting('about_1_title', $request->about_1_title);
        }
        if ($request->has('about_1_sub_title')) {
            setSystemSetting('about_1_sub_title', $request->about_1_sub_title);
        }
        if ($request->hasFile('about_1_image')) {
            $image = fileUpload($request->about_1_image, 'landing', '');
            setSystemSetting('about_1_image', $image);
        }
        //about 1 section

        if ($request->has('about_2_title')) {
            setSystemSetting('about_2_title', $request->about_2_title);
        }
        if ($request->has('about_2_sub_title')) {
            setSystemSetting('about_2_sub_title', $request->about_2_sub_title);
        }
        if ($request->hasFile('about_2_image')) {
            $image = fileUpload($request->about_2_image, 'landing', '');
            setSystemSetting('about_2_image', $image);
        }
        //about 2 section


        if ($request->has('contact_sub_title')) {
            setSystemSetting('contact_sub_title', $request->contact_sub_title);
        }

       
        return back()->with([
            'message' => translate('Others page static contend successfully updated'),
            'type' => 'success',
            'title' => translate('Success')
        ]);
    }


    public function googleMap()
    {
        return view('dashboard.google.map');
    }

    public function googleMapStore(Request $request)
    {
        if ($request->has('google_Key')) {
            setSystemSetting('google_Key', $request->google_Key);
        }
        return back()->with([
            'message' => translate('Google Map  api successfully updated'),
            'type' => 'success',
            'title' => translate('Success')
        ]);
    }

    //darkmood active

    public function darkMood(Request $request)
    {
        $response = new Response('Hello World');
        if ($request->cookie('darkmood') != null) {
            $response->withCookie(Cookie::forget('darkmood'));
            return $response;
        } else {
            $response->withCookie(cookie('darkmood', 'dark', 120));
            return $response;
        }
        return response()->json(['message' => Cookie::get('darkmood')]);
    }


    //hare is the config data 





}

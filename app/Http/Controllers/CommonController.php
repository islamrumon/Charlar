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
use App\Models\Page;
use App\Models\PageGroup;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

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
        $posts = BlogPost::where('is_published',true)->get();
        return view('dashboard.links',compact('pages','posts'));
    }

   


    public function seoSetup()
    {
        return view('dashboard.common.setting.seo');
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




        return back()->with(['message'=>translate('SEO Setup successfull'),
        'type'=>'success',
        'title'=>translate('Success')]);;
    }




    public function clearCash(){
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

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->route('dashboard')->with(['message'=>translate('Your Password is changed'),
        'type'=>'success',
        'title'=>translate('Success')]);

    }

    public function systemSetting()
    {
        return view('dashboard.common.setting.systemSetting');
    }

    public function systemSettingSetup(Request $request)
    {
        if($request->has('slider_title')){
            setSystemSetting('slider_title',$request->slider_title);
        }

        if($request->has('slider_sub_title')){
            setSystemSetting('slider_sub_title',$request->slider_sub_title);
        }

        if($request->has('featured_title')){
            setSystemSetting('featured_title',$request->featured_title);
        }

        if($request->has('featured_sub_title')){
            setSystemSetting('featured_sub_title',$request->featured_sub_title);
        }

        if($request->has('recommend_title')){
            setSystemSetting('recommend_title',$request->recommend_title);
        }

        if($request->has('recommend_sub_title')){
            setSystemSetting('recommend_sub_title',$request->recommend_sub_title);
        }

        if($request->has('trending_title')){
            setSystemSetting('trending_title',$request->trending_title);
        }

        if($request->has('trending_sub_title')){
            setSystemSetting('trending_sub_title',$request->trending_sub_title);
        }

        if($request->has('top_title')){
            setSystemSetting('top_title',$request->top_title);
        }

        if($request->has('top_sub_title')){
            setSystemSetting('top_sub_title',$request->top_sub_title);
        }
        if($request->has('city_title')){
            setSystemSetting('city_title',$request->city_title);
        }
        if($request->has('city_sub_title')){
            setSystemSetting('city_sub_title',$request->city_sub_title);
        }
        if($request->has('slider_sub_title')){
            setSystemSetting('slider_sub_title',$request->slider_sub_title);
        }
        if($request->has('advertise_title')){
            setSystemSetting('advertise_title',$request->advertise_title);
        }
        if($request->has('advertise_title')){
            setSystemSetting('advertise_title',$request->advertise_title);
        }

        if($request->has('advertise_sub_title')){
            setSystemSetting('advertise_sub_title',$request->advertise_sub_title);
        }
        if($request->has('plane_title')){
            setSystemSetting('plane_title',$request->plane_title);
        }
        if($request->has('plane_sub_title')){
            setSystemSetting('plane_sub_title',$request->plane_sub_title);
        }

        if($request->has('dashboard_text')){
            setSystemSetting('dashboard_text',$request->dashboard_text);
        }

        if($request->hasFile('dashboard_image')){
            $image = fileUpload($request->dashboard_image,'ads','');
            setSystemSetting('dashboard_image',$image);
        }

        return back()->with(['message'=>translate('Home page static contend successfully updated'),
        'type'=>'success',
        'title'=>translate('Success')]);
    }

    public function othersPageStaticContentForm()
    {
        return view('dashboard.page.other');
    }
    public function othersPage(Request $request)
    {
        if($request->has('category_title')){
            setSystemSetting('category_title',$request->category_title);
        }

        if($request->hasFile('category_image')){
            $image = fileUpload($request->category_image,'ads','');
            setSystemSetting('category_image',$image);
        }

        if($request->has('category_sub_title')){
            setSystemSetting('category_sub_title',$request->category_sub_title);
        }

        if($request->has('state_title')){
            setSystemSetting('state_title',$request->state_title);
        }

        if($request->hasFile('state_image')){
            $image = fileUpload($request->state_image,'ads','');
            setSystemSetting('state_image',$image);
        }

        if($request->has('state_sub_title')){
            setSystemSetting('state_sub_title',$request->state_sub_title);
        }


        if($request->has('dashboard_text')){
            setSystemSetting('dashboard_text',$request->dashboard_text);
        }

        if($request->has('ads_page_title')){
            setSystemSetting('ads_page_title',$request->ads_page_title);
        }

        if($request->has('ads_page_sub_title')){
            setSystemSetting('ads_page_sub_title',$request->ads_page_sub_title);
        }

        if($request->hasFile('ads_page_image')){
            $image = fileUpload($request->ads_page_image,'ads','');
            setSystemSetting('ads_page_image',$image);
        }
        if($request->hasFile('ad_details_image')){
            $image = fileUpload($request->ad_details_image,'ads','');
            setSystemSetting('ad_details_image',$image);
        }

        if($request->hasFile('login_banner')){
            $image = fileUpload($request->login_banner,'ads','');
            setSystemSetting('login_banner',$image);
        }

        if($request->has('related_ads_text')){
            setSystemSetting('related_ads_text',$request->related_ads_text);
        }
        return back()->with(['message'=>translate('Others page static contend successfully updated'),
        'type'=>'success',
        'title'=>translate('Success')]);

    }


    public function googleMap()
    {
        return view('dashboard.google.map');
    }

    public function googleMapStore(Request $request)
    {
        if($request->has('google_Key')){
            setSystemSetting('google_Key',$request->google_Key);
        }
        return back()->with(['message'=>translate('Google Map  api successfully updated'),
        'type'=>'success',
        'title'=>translate('Success')]);
    }





}

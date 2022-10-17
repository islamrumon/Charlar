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
        if ($request->has('category_title')) {
            setSystemSetting('category_title', $request->category_title);
        }
        if ($request->has('category_sub_title')) {
            setSystemSetting('category_sub_title', $request->category_sub_title);
        }

        if ($request->has('state_title')) {
            setSystemSetting('state_title', $request->state_title);
        }

        if ($request->has('state_sub_title')) {
            setSystemSetting('state_sub_title', $request->state_sub_title);
        }

        if ($request->has('advertise_title')) {
            setSystemSetting('advertise_title', $request->advertise_title);
        }
        if ($request->has('advertise_sub_title')) {
            setSystemSetting('advertise_sub_title', $request->advertise_sub_title);
        }
        if ($request->has('plane_title_2')) {
            setSystemSetting('plane_title_2', $request->plane_title_2);
        }
        if ($request->has('plane_sub_title')) {
            setSystemSetting('plane_sub_title', $request->plane_sub_title);
        }

        if ($request->has('ads_page_title')) {
            setSystemSetting('ads_page_title', $request->ads_page_title);
        }

        if ($request->has('ads_page_sub_title')) {
            setSystemSetting('ads_page_sub_title', $request->ads_page_sub_title);
        }

        if ($request->has('subscribe_title')) {
            setSystemSetting('subscribe_title', $request->subscribe_title);
        }
        if ($request->has('subscribe_sub_title')) {
            setSystemSetting('subscribe_sub_title', $request->subscribe_sub_title);
        }
        if ($request->has('footer_location')) {
            setSystemSetting('footer_location', $request->footer_location);
        }


        if ($request->has('footer_number')) {
            setSystemSetting('footer_number', $request->footer_number);
        }
        if ($request->has('footer_mail')) {
            setSystemSetting('footer_mail', $request->footer_mail);
        }

        if ($request->has('login_ad_line_1')) {
            setSystemSetting('login_ad_line_1', $request->login_ad_line_1);
        }
        if ($request->has('login_ad_line_2')) {
            setSystemSetting('login_ad_line_2', $request->login_ad_line_2);
        }
        if ($request->has('login_ad_line_3')) {
            setSystemSetting('login_ad_line_3', $request->login_ad_line_3);
        }

        if ($request->has('related_ads_text')) {
            setSystemSetting('related_ads_text', $request->related_ads_text);
        }

        if ($request->has('dashboard_text')) {
            setSystemSetting('dashboard_text', $request->dashboard_text);
        }

        if ($request->has('payment_image')) {
            $payment_image = fileUpload($request->payment_image, 'site', 'payment_image');
            setSystemSetting('payment_image', $payment_image);
        }
        if ($request->has('app_image')) {
            $app_image = fileUpload($request->app_image, 'site', 'app_image');
            setSystemSetting('app_image', $app_image);
        }
        if ($request->has('dashboard_text')) {
            setSystemSetting('dashboard_text', $request->dashboard_text);
        }


        if ($request->hasFile('login_banner')) {
            $login_banner = fileUpload($request->login_banner, 'site', 'login_banner');
            setSystemSetting('login_banner', $login_banner);
        }

        if ($request->hasFile('pre_loader')) {
            $pre_loader = fileUpload($request->pre_loader, 'site', 'pre_loader');
            setSystemSetting('pre_loader', $pre_loader);
        }



        if ($request->hasFile('ads_page_image')) {
            $ads_page_image = fileUpload($request->ads_page_image, 'site', 'posts_image');
            setSystemSetting('ads_page_image', $ads_page_image);
        }

        if ($request->hasFile('ad_details_image')) {
            $ad_details_image = fileUpload($request->ad_details_image, 'site', 'posts_image');
            setSystemSetting('ad_details_image', $ad_details_image);
        }

        if ($request->hasFile('dashboard_image')) {
            $dashboard_image = fileUpload($request->dashboard_image, 'site', 'posts_image');
            setSystemSetting('dashboard_image', $dashboard_image);
        }

        if ($request->hasFile('state_image')) {
            $state_image = fileUpload($request->state_image, 'site', 'posts_image');
            setSystemSetting('state_image', $state_image);
        }

        if ($request->hasFile('category_image')) {
            $category_image = fileUpload($request->category_image, 'site', 'posts_image');
            setSystemSetting('category_image', $category_image);
        }


        if ($request->hasFile('posts_image')) {
            $posts_image = fileUpload($request->posts_image, 'site', 'posts_image');
            setSystemSetting('posts_image', $posts_image);
        }

        if ($request->hasFile('post_details')) {
            $post_details = fileUpload($request->post_details, 'site', 'post_details');
            setSystemSetting('post_details', $post_details);
        }

        if ($request->has('blog_module_active')) {
            setSystemSetting('blog_module_active', $request->blog_module_active);
        }
        if ($request->has('blog_subtitle')) {
            setSystemSetting('blog_subtitle', $request->blog_subtitle);
        }
        if ($request->has('blog_title_2')) {
            setSystemSetting('blog_title_2', $request->blog_title_2);
        }
        if ($request->has('blog_list')) {
            setSystemSetting('blog_list', $request->blog_list);
        }

        if ($request->has('multi_lang')) {
            setSystemSetting('multi_lang', $request->multi_lang);
        }

        if ($request->has('multi_currency')) {
            setSystemSetting('multi_currency', $request->multi_currency);
        }
        return back()->with(['message' => translate('Site setting is done'), 'type' => 'success', 'title' => translate('Success')]);
    }
}

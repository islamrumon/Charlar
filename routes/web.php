<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\google\AnalyticsController;
use App\Http\Controllers\Dashboard\MenuController;
use App\Http\Controllers\Dashboard\SocialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group(function () {
    Route::get('auth', [FacebookController::class, 'loginUsing'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFrom'])->name('callback');
});


// Google URL
Route::prefix('google')->name('google.')->group(function () {
    Route::get('login', [GoogleController::class, 'loginUsing'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFrom'])->name('callback');
});


Route::get('/clear', [CommonController::class, 'clearCash'])->name('clear.site');


Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.dashboard'); //->middleware('permissions:analytics_dashboard');
    //there are the user Manager section
    
    Route::post('user/store/first',[CommonController::class,'userStoreFirst'])->name('user.store.first');
    Route::get('user/create', [CommonController::class, 'userCreate'])->name('users.create'); //->middleware('permissions:user_managment');
    Route::get('user/destroy/{id}', [CommonController::class, 'userDestroy'])->name('users.destroy'); //->middleware('permissions:user_managment');
    Route::get('user/edit/{id}', [CommonController::class, 'userEdit'])->name('users.edit'); //->middleware('permissions:user_managment');
    Route::post('user/update/first',[CommonController::class,'userUpdateFirst'])->name('user.update.first');
    Route::post('user/update', [CommonController::class, 'userUpdate'])->name('users.update'); //->middleware('permissions:user_managment'); 
    Route::get('user/profile', [CommonController::class, 'userProfile'])->name('users.profile');
    Route::get('user/profile/{id}', [CommonController::class, 'userShow'])->name('users.show'); //->middleware('permissions:user_managment');
    Route::get('user', [CommonController::class, 'userIndex'])->name('users.index'); //->middleware('permissions:user_managment');
    Route::get('user/banned/{id}', [CommonController::class, 'userBanned'])->name('users.banned'); //->middleware('permissions:user_managment');
    Route::get('user/active/{id}', [CommonController::class, 'userActive'])->name('users.active');
    
    
    //permission
    Route::get('permission/destroy/{id}', [CommonController::class, 'permissionDestroy'])->name('permissions.destroy'); //->middleware('permissions:user_managment');
    Route::get('permission/create', [CommonController::class, 'permissionCreate'])->name('permissions.create'); //->middleware('permissions:user_managment');
    Route::post('permission/store', [CommonController::class, 'permissionStore'])->name('permissions.store'); //->middleware('permissions:user_managment');
    Route::get('permission/edit/{id}', [CommonController::class, 'permissionEdit'])->name('permissions.edit'); //->middleware('permissions:user_managment');
    Route::post('permission/update', [CommonController::class, 'permissionUpdate'])->name('permissions.update'); //->middleware('permissions:user_managment');
    Route::get('permission/show/{id}', [CommonController::class, 'permissionShow'])->name('permissions.show'); //->middleware('permissions:user_managment');
    Route::get('permission', [CommonController::class, 'permissionIndex'])->name('permissions.index'); //->middleware('permissions:user_managment');

    //group
    Route::get('group/destroy/{id}', [CommonController::class, 'groupDestroy'])->name('groups.destroy'); //->middleware('permissions:user_managment');
    Route::get('group/create', [CommonController::class, 'groupCreate'])->name('groups.create'); //->middleware('permissions:user_managment');
    Route::post('group/store', [CommonController::class, 'groupStore'])->name('groups.store'); //->middleware('permissions:user_managment');
    Route::get('group/edit/{id}', [CommonController::class, 'groupEdit'])->name('groups.edit'); //->middleware('permissions:user_managment');
    Route::post('group/update', [CommonController::class, 'groupUpdate'])->name('groups.update'); //->middleware('permissions:user_managment');
    Route::get('group/show/{id}', [CommonController::class, 'groupShow'])->name('groups.show'); //->middleware('permissions:user_managment');
    Route::get('group', [CommonController::class, 'groupIndex'])->name('groups.index'); //->middleware('permissions:user_managment');

    //module
    Route::get('module/index', [CommonController::class, 'moduleIndex'])->name('modules.index'); //->middleware('permissions:user_managment');
    Route::post('module/store', [CommonController::class, 'moduleStore'])->name('modules.store'); //->middleware('permissions:user_managment');
    Route::get('module/destroy/{id}', [CommonController::class, 'moduleDestroy'])->name('modules.destroy'); //->middleware('permissions:user_managment');
    Route::get('module/edit/{id}', [CommonController::class, 'moduleEdit'])->name('modules.edit'); //->middleware('permissions:user_managment');
    Route::post('module/update', [CommonController::class, 'moduleUpdate'])->name('modules.update');


    //SMTP Setting
    Route::get('smtp', [CommonController::class, 'smtpCreate'])->name('smtp.create'); //->middleware('permissions:mail_setup');
    Route::post('smtp/store', [CommonController::class, 'smtpStore'])->name('smtp.store'); //->middleware('permissions:mail_setup');


    //site setting
    Route::get('setting', [CommonController::class, 'siteSetting'])->name('site.setting'); //->middleware('permissions:setting');
    Route::post('setting/update', [CommonController::class, 'siteSettingUpdate'])->name('site.update'); //->middleware('permissions:setting');
    Route::get('system/setting', [CommonController::class, 'systemSetting'])->name('system.setting'); //->middleware('permissions:setting');
    Route::post('system/setting/update', [CommonController::class, 'systemSettingUpdate'])->name('system.update'); //->middleware('permissions:setting');


    //Currency Setting
    Route::get('currency', [CommonController::class, 'currencyIndex'])->name('currencies.index'); //->middleware('permissions:currency_setup');
    Route::get('currency/create', [CommonController::class, 'currencyCreate'])->name('currencies.create'); //->middleware('permissions:currency_setup');
    Route::post('currency/store', [CommonController::class, 'currencyStore'])->name('currencies.store'); //->middleware('permissions:currency_setup');
    Route::get('currency/delete/{id}', [CommonController::class, 'currencyDestroy'])->name('currencies.destroy'); //->middleware('permissions:currency_setup');
    Route::get('currency/edit/{id}', [CommonController::class, 'currencyEdit'])->name('currencies.edit'); //->middleware('permissions:currency_setup');
    Route::post('currency/update', [CommonController::class, 'currencyUpdate'])->name('currencies.update'); //->middleware('permissions:currency_setup');
    Route::post('currency/default', [CommonController::class, 'currencyDefault'])->name('currencies.default');
    Route::get('currency/published', [CommonController::class, 'currencyAlignment'])->name('currencies.published');
    Route::get('currency/align', [CommonController::class, 'currencyAlignment'])->name('currencies.align');



    //all pages
    Route::get('page/groups', [CommonController::class, 'pageGroupIndex'])->name('page.group.index'); //->middleware('permissions:page_managment');
    Route::post('page/group/store', [CommonController::class, 'pageGroupSave'])->name('page.group.store'); //->middleware('permissions:page_managment');
    Route::get('page/group/edit/{id}', [CommonController::class, 'pageGroupEdit'])->name('page.group.edit'); //->middleware('permissions:page_managment');
    Route::post('page/group/update', [CommonController::class, 'pageGroupUpdate'])->name('page.group.update'); //->middleware('permissions:page_managment');
    Route::get('page/group/destroy/{id}', [CommonController::class, 'pageGroupDestroy'])->name('page.group.destroy'); //->middleware('permissions:page_managment');
    Route::get('pages', [CommonController::class, 'pageIndex'])->name('pages.index'); //->middleware('permissions:page_managment');
    Route::get('pages/create', [CommonController::class, 'pageCreate'])->name('pages.create'); //->middleware('permissions:page_managment');
    Route::get('pages/delete/{id}', [CommonController::class, 'pageDestroy'])->name('pages.destroy'); //->middleware('permissions:page_managment');
    Route::post('pages/store', [CommonController::class, 'pageStore'])->name('pages.store'); //->middleware('permissions:page_managment');
    Route::get('pages/edit/{id}', [CommonController::class, 'pageEdit'])->name('pages.edit'); //->middleware('permissions:page_managment');
    Route::post('pages/update', [CommonController::class, 'pageUpdate'])->name('pages.update'); //->middleware('permissions:page_managment');
    Route::get('pages/active', [CommonController::class, 'pageActive'])->name('pages.active'); //->middleware('permissions:page_managment');
    Route::get('pages/authorize', [CommonController::class, 'pageAuthorize'])->name('pages.authorize'); //->middleware('permissions:page_managment');
    Route::get('content/{id}', [CommonController::class, 'contentIndex'])->name('pages.content.index'); //->middleware('permissions:page_managment');
    Route::get('pages/content/create/{id}', [CommonController::class, 'contentCreate'])->name('pages.content.create'); //->middleware('permissions:page_managment');
    Route::post('pages/content/store', [CommonController::class, 'contentStore'])->name('pages.content.store'); //->middleware('permissions:page_managment');
    Route::get('pages/content/active', [CommonController::class, 'contentActive'])->name('pages.content.active'); //->middleware('permissions:page_managment');
    Route::get('pages/content/edit/{id}', [CommonController::class, 'contentEdit'])->name('pages.content.edit'); //->middleware('permissions:page_managment');
    Route::post('pages/content/update', [CommonController::class, 'contentUpdate'])->name('pages.content.update'); //->middleware('permissions:page_managment');
    Route::get('pages/content/delete/{id}', [CommonController::class, 'contentDestroy'])->name('pages.content.destroy'); //->middleware('permissions:page_managment');


    //Category
    Route::get('category/create', [CommonController::class, 'categoryCreate'])->name('categories.create'); //->middleware('permissions:category_managment');
    Route::post('category/store', [CommonController::class, 'categoryStore'])->name('categories.store'); //->middleware('permissions:category_managment');
    Route::get('category/edit/{id}', [CommonController::class, 'categoryEdit'])->name('categories.edit'); //->middleware('permissions:category_managment');
    Route::post('category/update', [CommonController::class, 'categoryUpdate'])->name('categories.update'); //->middleware('permissions:category_managment');
    Route::get('category/destroy/{id}', [CommonController::class, 'categoryDestroy'])->name('categories.destroy'); //->middleware('permissions:category_managment');
    Route::get('category', [CommonController::class, 'categoryIndex'])->name('categories.index'); //->middleware('permissions:category_managment');

    //this route for published or unpublished
    Route::get('category/published', [CommonController::class, 'categoryPublished'])->name('categories.published'); //->middleware('permissions:category_managment');
    Route::get('category/popular', [CommonController::class, 'categoryPopular'])->name('categories.popular'); //->middleware('permissions:category_managment');
    Route::get('category/top', [CommonController::class, 'categoryTop'])->name('categories.top'); //->middleware('permissions:category_managment');




  

   

   

 



    //change password
    Route::get('change/password', [CommonController::class, 'changePassword'])->name('change.password');
    Route::post('password/update', [CommonController::class, 'changeUpdate'])->name('change.password.update');

    //seo setup
    Route::get('seo/setup', [CommonController::class, 'seoSetup'])->name('seo.setup'); //->middleware('permissions:seo');
    Route::post('seo/update', [CommonController::class, 'seoUpdate'])->name('seo.update'); //->middleware('permissions:seo');

   

    


  

    //static contetn
    Route::get('page/home', [CommonController::class, 'homePageStaticContentForm'])->name('home.page'); //->middleware('permissions:page_managment');
    Route::post('page/home/store', [CommonController::class, 'homePageContent'])->name('home.page.store'); //->middleware('permissions:page_managment');
    Route::get('page/others', [CommonController::class, 'othersPageStaticContentForm'])->name('other.page'); //->middleware('permissions:page_managment');
    Route::post('page/others/store', [CommonController::class, 'othersPage'])->name('other.page.store'); //->middleware('permissions:page_managment');

 

    //social login
    Route::get('social/credential', [SocialController::class, 'index'])->name('social.credebtial'); //->middleware('permissions:login_setting');
    Route::post('social/facebook', [SocialController::class, 'facebookStore'])->name('social.facebook.store'); //->middleware('permissions:login_setting');
    Route::post('social/google', [SocialController::class, 'googleStore'])->name('social.google.store'); //->middleware('permissions:login_setting');

    //google analytics
    Route::get('google/analytics', [AnalyticsController::class, 'googleAnalytics'])->name('google.analytics'); //->middleware('permissions:setting');
    Route::post('google/analytics/store', [AnalyticsController::class, 'googleAnalyticsStore'])->name('google.analytics.store'); //->middleware('permissions:setting');

    //google map
    Route::get('google/map/setup', [CommonController::class, 'googleMap'])->name('google.map'); //->middleware('permissions:setting');
    Route::post('google/map/store', [CommonController::class, 'googleMapStore'])->name('google.map.store'); //->middleware('permissions:setting');

    //firebase
    Route::get('google/firebase', [FcmController::class, 'fcmIndex'])->name('google.firebase'); //->middleware('permissions:setting');
    Route::post('google/firebase/store', [FcmController::class, 'fcmStore'])->name('google.firebase.store'); //->middleware('permissions:setting');

    //push notifications
    Route::get('push/fcm', [FcmController::class, 'googlePush'])->name('google.push'); //->middleware('permissions:push_notification');
    Route::post('push/fcm/store', [FcmController::class, 'googlePushStore'])->name('google.push.store'); //->middleware('permissions:push_notification');
    Route::get('push/notify/logs', [FcmController::class, 'googleNotifyLogs'])->name('google.notify.logs'); //->middleware('permissions:push_notification');
    Route::get('push/notify', [FcmController::class, 'googlePushNotify'])->name('google.push.notify'); //->middleware('permissions:push_notification');
    Route::post('push/notify/store', [FcmController::class, 'googlePushNotifyStore'])->name('google.push.notify.store'); //->middleware('permissions:push_notification');

    //blog
    Route::get('blog/category', [CategoryController::class, 'index'])->name('blog.categories.index'); //->middleware('permissions:blog_module');
    Route::post('blog/category/store', [CategoryController::class, 'store'])->name('blog.categories.store'); //->middleware('permissions:blog_module');
    Route::get('blog/category/edit/{id}', [CategoryController::class, 'edit'])->name('blog.categories.edit'); //->middleware('permissions:blog_module');
    Route::post('blog/category/update', [CategoryController::class, 'update'])->name('blog.categories.update'); //->middleware('permissions:blog_module');
    Route::get('blog/category/published', [CategoryController::class, 'isPublished'])->name('blog.categories.published'); //->middleware('permissions:blog_module');

    Route::get('blog/post/index', [PostController::class, 'index'])->name('blog.post.index'); //->middleware('permissions:blog_module');
    Route::get('blog/post/create', [PostController::class, 'create'])->name('blog.post.create'); //->middleware('permissions:blog_module');
    Route::get('blog/post/edit/{id}', [PostController::class, 'edit'])->name('blog.post.edit'); //->middleware('permissions:blog_module');
    Route::get('blog/post/delete/{id}', [PostController::class, 'delete'])->name('blog.post.delete'); //->middleware('permissions:blog_module');
    Route::get('blog/post/published', [PostController::class, 'isPublished'])->name('blog.post.published'); //->middleware('permissions:blog_module');
    Route::get('blog/post/popular', [PostController::class, 'isPopular'])->name('blog.post.popular'); //->middleware('permissions:blog_module');
    Route::post('blog/post/store', [PostController::class, 'store'])->name('blog.post.store'); //->middleware('permissions:blog_module');
    Route::post('blog/post/update', [PostController::class, 'update'])->name('blog.post.update'); //->middleware('permissions:blog_module');


  


    //    menu
    //menu
    Route::get('menu', [MenuController::class, 'index'])->name('menu');
    Route::post('menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::get('menu/published', [MenuController::class, 'published'])->name('menu.published');
    Route::get('menu/details/{id}', [MenuController::class, 'menuDetails'])->name('menu.details');
    //menu items
    Route::post('menu/item/store', [MenuController::class, 'itemStore'])->name('menu.item.store');
    Route::get('menu/item/published', [MenuController::class, 'itemPublished'])->name('menu.item.published');
    Route::get('menu/item/edit/{id}', [MenuController::class, 'itemEdit'])->name('menu.item.edit');
    Route::post('menu/update', [MenuController::class, 'itemUpdate'])->name('menu.item.update');
    //package
    Route::post('menu/custom', [MenuController::class, 'addcustommenu'])->name('addcustommenu'); //->middleware('permissions:menu-manage');
    Route::post('menu/delete/item', [MenuController::class, 'deleteitemmenu'])->name('deleteitemmenu'); //->middleware('permissions:menu-manage');
    Route::post('menu/delete', [MenuController::class, 'deletemenug'])->name('deletemenug'); //->middleware('permissions:menu-manage');
    Route::post('create/new/menu', [MenuController::class, 'createnewmenu'])->name('createnewmenu'); //->middleware('permissions:menu-manage');
    Route::post('/generate/menu/control', [MenuController::class, 'generatemenucontrol'])->name('generatemenucontrol'); //->middleware('permissions:menu-manage');
    Route::post('update/item', [MenuController::class, 'updateitem'])->name('updateitem'); //->middleware('permissions:menu-manage');


    // link
    Route::get('links', [CommonController::class, 'links'])->name('urls');

    
    
});




// Route::get('/', function () {
//     // return view('layouts.master');
//     return view('dashboard.home.index');
// })->name('dashboard');

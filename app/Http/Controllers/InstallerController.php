<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class InstallerController extends Controller
{




    protected function welcome()
    {


        overWriteEnvFile('APP_URL', URL::to('/'));

        return view('install.welcome');
    }

    // permission
    protected function permission()
    {

        $permission['curl_enabled'] = function_exists('curl_version');
        $permission['db_file_write_perm'] = is_writable(base_path('.env'));
        $permission['storage'] = is_writable(base_path('storage'));
        $permission['bootstrap'] = is_readable(base_path('bootstrap/cache'));
        $permission['public'] = is_writable(base_path('public'));
        $permission['htaccess'] = is_readable(base_path('.htaccess'));

        return view('install.permission', compact('permission'));
    }

    // create
    protected function create()
    {


        return view('install.setup');
    }

    //save database information in env file
    //here the get database key or data for env file
    // clear cache
    protected function dbStore(Request $request)
    {

        foreach ($request->types as $type) {
            //here the get database key or data for env file
            overWriteEnvFile($type, $request[$type]);
        }

        return redirect()->route('check.db');
    }

    // checkDbConnection
    protected function checkDbConnection()
    {

        try {
            //check the database connection for import the sql file
            DB::connection()->getPdo();

            return redirect()->route('sql.setup')->with('success', 'Your database connection done successfully');
        } catch (\Exception $e) {
            return redirect()->route('sql.setup')->with('wrong', 'Could not connect to the database. Please check your configuration');
        }
    }


    //import sql page
    protected function importSql()
    {

        return view('install.importSql');
    }

    //import the sql file in database or goto organization setup page
    protected function sqlUpload()
    {

        try {
            //import the sql file in database
            $sql_path = base_path('install.sql');
            DB::unprepared(file_get_contents($sql_path)); // uploaded sql

            return view('install.setupOrg');
        } catch (\Exception $e) {
            die("There are some problems, Please check your configuration. error:" . $e);
        }
    }

    //store the organization details in db
    protected function orgSetup(Request $request)
    {
        if ($request->hasFile('logo')) {
            $logo = fileUpload($request->logo, 'site', 'own_site');
            setSystemSetting('type_logo', $logo);
        }
        if ($request->hasFile('f_icon')) {
            $f_icon = fileUpload($request->f_icon, 'site', 'f_icon');
            setSystemSetting('favicon_icon', $f_icon);
        }

        if ($request->hasFile('f_logo')) {
            $f_logo = fileUpload($request->f_logo, 'site', 'footer_logo');
            setSystemSetting('footer_logo', $f_logo);
        }
        if ($request->has('name')) {
            setSystemSetting($request->type_name, $request->name);
            overWriteEnvFile('APP_NAME', $request->name);
        }
        if ($request->has('footer')) {
            setSystemSetting($request->type_footer, $request->footer);
        }
        if ($request->has('fb')) {
            setSystemSetting($request->type_fb, $request->fb);
        }
        if ($request->has('tw')) {
            setSystemSetting($request->type_tw, $request->tw);
        }
        if ($request->has('google')) {
            setSystemSetting($request->type_google, $request->google);
        }
        if ($request->has('address')) {
            setSystemSetting($request->type_address, $request->address);
        }
        if ($request->has('number')) {
            setSystemSetting($request->type_number, $request->number);
        }
        if ($request->has('mail')) {
            setSystemSetting($request->type_mail, $request->mail);
        }

        return redirect()->route('admin.create');
    }

    //admin create page
    public function adminCreate()
    {
        return view('install.user');
    }

    //create a admin with full access
    //save and add the super access permission
    // replace the RouteService provider when installation is done
    //return the dashboard when all is done
    protected function adminStore(Request $request)
    {

        $request->validate(
            [
                'name'      => ['required', 'string', 'max:255', 'unique:users'],
                'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'  => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'name.required' => translate('Name is required'),
                'name.unique' => translate('Name already exist'),
                'email.required' => translate('Email is required'),
                'email.email' => translate('invalid email'),
                'email.unique' => translate('Email already exist'),
                'password.unique' => translate('Password is required'),
                'password.min' => translate('Password must be minimum 8 characters'),
                'password.confirmed' => translate('Password did not matched'),
            ]
        );
        //create admin and hash password
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = 'admin';
        $user->password = Hash::make($request->password);
        //slug save
        $user->slug = Str::slug($request->name);
        if ($user->save()) {
            $user->assignGroup(1);
            //replace the env file
            $se = Str::before(env('APP_URL'), '/public');
            overWriteEnvFile('APP_URL', $se);
            copy(public_path('RouteServiceProvider.php'), base_path('app/Providers/RouteServiceProvider.php'));

            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('view:clear');

            App::setLocale(env('DEFAULT_LANGUAGE'));
            return view('install.done');
        } else {
            return redirect()->back()->with('failed', translate('There are some problem try again'));
        }
    }
}

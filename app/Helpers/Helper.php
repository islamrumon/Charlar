<?php

//this function for open Json file to read language json file

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;

function routeValEncode($value){
    return Crypt::encrypt($value);
}

function routeValDecode($value){
    return Crypt::decrypt($value);
}

function openJSONFile($code)
{
    $jsonString = [];
    if (File::exists(base_path('resources/lang/' . $code . '.json'))) {
        $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
} // end it

function dateTimeFormat($date)
{
    return date('D-M-y', strtotime($date));
}

//save the new language json file
function saveJSONFile($code, $data)
{
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
}

//translate the key with json
function translate($keys)
{
    if(false){
        $key = $keys;
        if (File::exists(base_path('resources/lang/en.json'))) {
            $jsonString = file_get_contents(base_path('resources/lang/en.json'));
            $jsonString = json_decode($jsonString, true);
            if (!isset($jsonString[$key])) {
                $jsonString[$key] = $key;
                saveJSONFile('en', $jsonString);
            }
        }
    }
   
    
    return __($keys);
}

//scan directory for load flag
function readFlag()
{
    $dir = base_path('public/images/lang');
    $file = scandir($dir);
    return $file;
}


//auto Rename Flag
function flagRenameAuto($name)
{
    $nameSubStr = substr($name, 8);
    $nameReplace = ucfirst(str_replace('_', ' ', $nameSubStr));
    $nameReplace2 = ucfirst(str_replace('.png', '', $nameReplace));
    return $nameReplace2;
}

//format the Price
function formatPrice($price)
{
   $aling = true;
   $symbol = "$";
    return $aling == 0 ? number_format($price, 2) . $symbol : $symbol . number_format($price, 2);
}




/*Active Currency*/
function activeCurrency()
{

    return $symbol = "$";
}

//override or add env file or key
function overWriteEnvFile($type, $val)
{
    $path = base_path('.env'); // get file ENV path
    if (file_exists($path)) {
        $val = '"' . trim($val) . '"';
        if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
            file_put_contents($path, str_replace($type . '="' . env($type) . '"', $type . '=' . $val, file_get_contents($path)));
        } else {
            file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
        }
    }
}


//get system setting data
function getSystemSetting($key)
{
    return config('system.' . $key);
}

function setSystemSetting($key, $value)
{
    Config::write('system.' . $key, $value);
}

function rendomForDigite()
{
    return rand(1, 9999);
}

//Get file path
//path is storage/app/
function filePath($file)
{
    if ($file != null) {
        if (file_exists(public_path($file))) {
            return asset($file);
        }
    } else {
        return asset('images/placeholder-image.png');
    }
}

function fileUploadBase64($file_name, $image)
{
    try {
        $imagePath = null;
        $ext = substr($file_name, strlen($file_name) - 4, strlen($file_name) - 1);
        $fileName = time() . substr($file_name, 0, strlen($file_name) - 4);
        $imagePath = $fileName . $ext;
        /*here are the problem*/

        file_put_contents(public_path('uploads/') . $imagePath, base64_decode($image));
        return 'uploads/' . $imagePath;
    } catch (Exception $exception) {
        return null;
    }
}

//delete file
function fileDelete($file)
{
    if ($file != null) {
        if (file_exists(public_path($file))) {
            unlink(public_path($file));
        }
    }
}



/*check null*/
function checkNull($data)
{
    return $data == null ? 'N/A' : $data;
}

/*humans readable time*/
function timeForHumans($date)
{
    return \Carbon\Carbon::parse($date)->diffForHumans() ?? '';
}


/*Desktop Notification onn*/
function desktopNotificationOn(): bool
{
    return false;
}


function add_query_params(array $params = [])
{




    $query = array_merge(request()->query(), $params); // merge the existing query
    // parameters with the ones we want to add


    //add the url param
    $param = null;
    $value = null;
    foreach ($params as $key => $value) {
        $param = $key;
        $value = $value;
    }
    $ta = request()->ad_type;

    // merging new ones
    switch ($param) {
        case 'tag':
            $ta .= '-' . $value;
            $types = explode('-', $ta);
            $type = array_unique($types);
            $ta = '';
            foreach ($type as $t) {
                if ($t != null) {
                    $ta .= '-' . $t;
                }
            }
            $query = array_merge(request()->query(), ['ad_type' => $ta]);
            break;
        case 'some other param':
            // push value to array, like tags case
            break;
        default:
            break;
    }

    // return json_encode($tags);


    return route('home') . '?' . http_build_query($query); // rebuild the URL with the new parameters array
}



function paginate()
{
    return getSystemSetting('paginate');
}

function inputDate($date)
{
    return strftime('%Y-%m-%d', strtotime($date));
}


function fileUploadWithName($file,  $name, $extention = 'js')
{
    $imageName = $name. '.' . $extention;
    $file->move(base_path(), $imageName);
    $path = base_path().'/'. $imageName;
    copy($path, public_path().'/'.$imageName);
    return $path;
}


function fileUpload($file, $folder, $name)
{
    $imageName = Str::slug($name) . rendomForDigite() . '.' . $file->extension();
    $file->move(public_path('uploads/' . $folder), $imageName);
    $path = 'uploads/' . $folder . '/' . $imageName;
    return $path;
}


function htmlLang(){
    //this is html lang value,
    return 'en';
}


?>
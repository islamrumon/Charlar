<?php


namespace App\Http\Traits;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

trait LanguageTraits
{
    //list of language
    public function langIndex()
    {
        $languages = Language::all();
        return view('dashboard.common.setting.lang.language', compact('languages'));
    }


    //store a  new language
    public function langStore(Request $request)
    {
        $request->validate([
            'code' => ['required', 'unique:languages'],
            'name' => ['required', 'unique:languages'],
            'image' => ['required', 'unique:languages']
        ]);
        $lan = new Language();
        $lan->code = Str::lower(str_replace(' ', '_', $request->code));
        $lan->name = $request->name;
        $lan->image = $request->image;
        $lan->save();
        return back()->with(['message' => translate('Language Created Successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }

    //delete the language
    public function langDestroy($id)
    {
        Language::where('id', $id)->forceDelete();
        return back()->with(['message' => translate('Language Delete Successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }


    //languages for create translate
    public function translate_create($id)
    {
        $lang = Language::findOrFail($id);
        return view('dashboard.common.setting.lang.translate', compact('lang'));
    }


    //translate language save ase a json format file
    public function translate_store(Request $request)
    {
        $language = Language::findOrFail($request->id);

        //check the key have translate data
        $data = openJSONFile($language->code);
        foreach ($request->translations as $key => $value) {
            $data[$key] = removeTheSyambols($value);
        }

        //save the new keys translate data
       saveJSONFile($language->code, $data);
        return back()->with(['message' => translate('Translation has been saved'), 'type' => 'success', 'title' => translate('Success')]);
    }


    /*languages change in session*/
    public function languagesChange(Request $request)
    {

        session(['locale' => $request->code]);

        Artisan::call('optimize:clear');
        return back();
    }

    //defaultLanguage
    public function defaultLanguage($id)
    {
        $language = Language::findOrFail($id);
        overWriteEnvFile('DEFAULT_LANGUAGE', $language->code);
        config(['app.locale' => $language->code]);
        return back()->with(['message' => translate('Language  Is  Default or changed'), 'type' => 'success', 'title' => translate('Success')]);
    }


    // translate php file
    public function typeWaysTranslateCreate($id, $type)
    {

        $lang = Language::findOrFail($id);
        //need to check type is exixt, if not exist show me the error

        checkLangFileIsExists($lang->code, $type);
        
        $fields = trans($type, [], $lang->code);



        return view('dashboard.common.setting.lang.typeTranslate', compact('lang', 'type', 'fields'));
    }


    public function typeWaysTranslateUpdate(Request $request)
    {
        ini_set('max_input_vars', '200000');
        $language = Language::findOrFail($request->id);


        $datas = collect();
        $i = 0;

        foreach ($request->key  as $key) {
            $obj = new Language();
            $obj->key = $key;
            $obj->value = $request->value[$i];
            $datas->push($obj);
            $i++;
        }
        //need to check type is exixt, if not exist show me the error

        addTheLangKeysWithTypes($datas->unique(), $language->code, $request->type);


        return back()->with('success', translate('Translation has been saved.'));
    }

    //languages for create translate
    public function staticTranslateCreate($id)
    {
        $lang = Language::findOrFail($id);
        $configArray = config('system');
        $jsonArray = openJSONFile('en');

        $result = array_intersect_key($configArray,$jsonArray);


        return view('dashboard.common.setting.lang.translate', compact('lang','result'));
    }
}

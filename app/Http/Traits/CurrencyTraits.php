<?php


namespace App\Http\Traits;


use App\Models\Currency;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;


trait CurrencyTraits
{
    //show all currency in index page
    public function currencyIndex()
    {
        $currencies = Currency::all(); // this is for list
        $dCurrencies = Currency::published()->get();
        return view('dashboard.common.setting.currency.index', compact('currencies', 'dCurrencies'));
    }

    //create modal for currency
    public function currencyCreate()
    {
        return view('dashboard.common.setting.currency.create');
    }

    //store the currency in database
    public function currencyStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'symbol' => 'required',
            'rate' => 'required',
            'image'=>'required',
        ],
            [
                'name.required' => translate('Currency name is required'),
                'code.required' => translate('Currency code is required'),
                'symbol.required' => translate('Currency symbol is required'),
                'rate.required' => translate('Currency rate is required'),
                'image.required'=>translate('Currency flag is required'),
            ]);
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->code = Str::upper($request->code);
        $currency->symbol = $request->symbol;
        $currency->rate = $request->rate;
        $currency->image = $request->image;
        $currency->save();
        return back()->with(['message'=>translate('Currency created successfully'),'type'=>'success','title'=>translate('Success')]);
    }

    //edit modal for currency
    public function currencyEdit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('dashboard.common.setting.currency.edit', compact('currency'));
    }

    //update the currency
    public function currencyUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'symbol' => 'required',
            'rate' => 'required',
            'image'=>'required',
        ],
            [
                'name.required' => translate('Currency name is required'),
                'code.required' => translate('Currency code is required'),
                'symbol.required' => translate('Currency symbol is required'),
                'rate.required' => translate('Currency rate is required'),
                'image.required'=>translate('Currency flag is required'),
            ]);

        Currency::where('id', $request->id)->update([
            'name' => $request->name,
            'code' => Str::upper($request->code),
            'symbol' => $request->symbol,
            'rate' => $request->rate,
            'image' => $request->image,
        ]);
        return back()->with(['message'=>translate('Currency Updated successfully'),'type'=>'success','title'=>translate('Success')]);
    }

    //soft delete the currency
    public function currencyDestroy($id)
    {
        Currency::where('id', $id)->delete();
        return back()->with(['message'=>translate('Currency deleted successfully'),'type'=>'success','title'=>translate('Success')]);
    }

    //save currency default in database
    public function currencyDefault(Request $request)
    {
        if ($request->has('default')) {
            setSystemSetting('default_currencies', $request->default);
            overWriteEnvFile('default_currencies', $request->default);
        }
        return back()->with(['message'=>translate('Update currency default setting'),'type'=>'success','title'=>translate('Success')]);
    }

    //change the status
    public function currencyPublished(Request $request)
    {
        $currency = Currency::where('id', $request->id)->first();
        if ($currency->is_published == 1) {
            $currency->is_published = 0;
            $currency->save();
        } else {
            $currency->is_published = 1;
            $currency->save();
        }
        return response(['message' => translate('Currency status is change')], 200);
    }


    //change the status
    public function currencyAlignment(Request $request)
    {
        $currency = Currency::where('id', $request->id)->first();
        if ($currency->align == 1) {
            $currency->align = 0;
            $currency->save();
        } else {
            $currency->align = 1;
            $currency->save();
        }
        return response(['message' => translate('Currency align is change')], 200);
    }

    /*currencies change in session*/
    public function currenciesChange(Request $request)
    {
        session(['currency' => $request->id]);
        Artisan::call('optimize:clear');
        return back();
    }

}

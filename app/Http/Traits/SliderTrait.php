<?php


namespace App\Http\Traits;


use App\Models\Slider;
use Illuminate\Http\Request;

trait SliderTrait
{
    public function sliderIndex(){
        $sliders = Slider::all();
        return view('dashboard.common.slider.index',compact('sliders'));
    }

    public function sliderCreate(){
        return view('dashboard.common.slider.create');
    }

    public function sliderStore(Request $request){
        $slider = new Slider();
        $slider->url = $request->url;
        if($request->hasFile('image')){
            $slider->image = fileUpload($request->image,'slider','slider');
        }
        $slider->save();
        return back()->with(['message'=>translate('Slider created successfully'),'type'=>'success','title'=>translate('Success')]);
    }

    public function sliderEdit($id){
        $slider = Slider::find($id);
        return view('dashboard.common.slider.edit',compact('slider'));
    }

    public function sliderUpdate(Request $request){
        $slider = Slider::find($request->id);
        $slider->url = $request->url;
        if($request->hasFile('image')){
            fileDelete($slider->image);
            $slider->image = fileUpload($request->image,'slider','slider');
        }
        $slider->save();
        return back()->with(['message'=>translate('Slider updated successfully'),'type'=>'success','title'=>translate('Success')]);
    }

    public function sliderDestroy($id){
        $slider = Slider::find($id);
        fileDelete($slider->image);
        $slider->delete();
        return back()->with(['message'=>translate('Slider deleted successfully'),'type'=>'success','title'=>translate('Success')]);
    }


    public function sliderActive(Request $request)
    {
        // don't use this type of variable naming, use $category instead of $cat1
        $cat = Slider::where('id', $request->id)->first();
        if ($cat->is_active == 1) {
            $cat->is_active = 0;
            $cat->save();
        } else {
            $cat->is_active = 1;
            $cat->save();
        }
        return response(['message' => translate('Slider  active status is change ')], 200);
    }
}

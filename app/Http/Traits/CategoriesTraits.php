<?php


namespace App\Http\Traits;


use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


trait CategoriesTraits
{
    //show all category and search here
    public function categoryIndex(Request $request)
    {
        $categories = null;
        if ($request->get('search')) {
            $search = $request->search;
            $categories = Category::where('name', 'like', '%' . $search . '%')
                ->with('parent')
                ->get();
        } else {
            $categories = Category::with('parent')->get();
        }
        return view('dashboard.common.category.index', compact('categories'));
    }

    //create category model
    public function categoryCreate()
    {
        $categories = Category::published()->where('parent_category_id',0)->with('childrenCategories')->get();
        return view('dashboard.common.category.create', compact('categories'));
    }

    //store the category
    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => translate('Category name is required')
        ]);
        $category = new Category();
        $category->name = $request->name;

        $slug =Str::slug($request->name);
        /*check the slug*/
        $c = Category::where('slug',$slug)->get();
        if($c->count() >0){
            $category->slug = $slug.$c->count();
        }else{
            $category->slug =$slug;
        }
        if($request->hasFile('image')){
            $category->image = fileUpload($request->image,'category',$category->name);
        }
        if($request->hasFile('icon')){
            $category->icon = fileUpload($request->icon,'category',$category->name);
        }

        $category->meta_keys = $request->meta_keys;
        $category->meta_desc = $request->meta_desc;
        $category->parent_category_id = $request->parent_category_id ?? 0;
        $category->save();
        return back()->with(['message'=>translate('Category created successfully'),'type'=>'success','title'=>translate('Success')]);
    }

    //edit category model
    public function categoryEdit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::published()->where('parent_category_id',0)->with('childrenCategories')->get();
        return view('dashboard.common.category.edit', compact('category', 'categories'));
    }

    //update the category
    public function categoryUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => translate('Category name is required')
        ]);

        //save or delete the icon

        $category = Category::where('id',$request->id)->first();
        $category->name = $request->name;
        $slug =Str::slug($request->name);
        /*check the slug*/
        $c = Category::where('slug',$slug)->get();
        if($c->count() >0){
            $category->slug = $slug.$c->count();
        }else{
            $category->slug =$slug;
        }
        if ($request->hasFile('newImage')) {
            //delete the icon
            if ($request->image != null) {
                fileDelete($request->image);
            }
            //store the new icons
            //use store function, no more move_uploaded_files
            $category->image= fileUpload($request->newImage, 'category',$category->name);

        }
        if($request->hasFile('icon')){
             //delete the icon
             if ($request->icon != null) {
                fileDelete($request->icon);
            }
            $category->icon = fileUpload($request->icon,'category',$category->name);
        }

        $category->meta_keys = $request->meta_keys;
        $category->meta_desc = $request->meta_desc;
        $category->parent_category_id = $request->parent_category_id ?? 0;
        $category->save();
        return back()->with(['message'=>translate('Category update successfully'),'type'=>'success','title'=>translate('Success')]);
    }

    //soft delete the category
    public function categoryDestroy($id)
    {
        Category::where('id', $id)->delete();
        return back()->with('success',translate('Category delete successfully'));

    }

    //published
    public function categoryPublished(Request $request)
    {
        // don't use this type of variable naming, use $category instead of $cat1
        $cat = Category::where('id', $request->id)->first();
        if ($cat->is_published == 1) {
            $cat->is_published = 0;
            $cat->save();
        } else {
            $cat->is_published = 1;
            $cat->save();
        }
        return response(['message' => translate('Category active status is change ')], 200);
    }

    // published
    public function categoryPopular(Request $request)
    {
        // don't use this type of variable naming, use $category instead of $cat1
        $cat = Category::where('id', $request->id)->first();
        if ($cat->is_popular == 1) {
            $cat->is_popular = 0;
            $cat->save();
        } else {
            $cat->is_popular = 1;
            $cat->save();
        }
        return response(['message' => translate('Category popular status is change')], 200);
    }

    // published
    public function categoryTop(Request $request)
    {
        // don't use this type of variable naming, use $category instead of $cat1
        $cat = Category::where('id', $request->id)->first();
        if ($cat->is_top == 1) {
            $cat->is_top = 0;
        } else {
            $cat->is_top = 1;
        }
        $cat->save();
        return response(['message' => translate('Category top status is change')], 200);
    }
}

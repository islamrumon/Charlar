<?php

namespace App\Http\Controllers\Dashboard\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BlogCategory::all();
        return view('dashboard.blog.category.index',compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new BlogCategory();
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->save();
        return back()->with(['message'=>translate('Blog Category Created successfully'),'type'=>'success','title'=>translate('Success')]);
    }


    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('dashboard.blog.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = BlogCategory::findOrFail($request->id);
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->save();
        return back()->with(['message'=>translate('Blog category updated successfully'),'type'=>'success','title'=>translate('Success')]);
    }


    function isPublished(Request $request){
        $category = BlogCategory::findOrFail($request->id);
        if($category->is_published){
            $category->is_published = false;
        }else{
            $category->is_published = true;
        }
        $category->save();
        return response(['message' => translate('Blog Category published status is change')], 200);
    }

}

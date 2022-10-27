<?php

namespace App\Http\Controllers\Dashboard\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::all();
        return view('dashboard.blog.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::where('is_published', true)->get();
        return view('dashboard.blog.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
           
            'category_id' => 'required',

        ], [
            'title.required' => translate('Title is required'),
            'desc.required' => translate('Descriptions is required'),
            'category_id.required' => translate('Category is required'),
        ]);
        $post = new  BlogPost();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->desc = $request->desc;
        $post->user_id = Auth::id();
        $post->category_id = $request->category_id;
        $post->meta_keys = $request->meta_keys;
        $post->meta_desc = $request->meta_desc;
        $post->meta_title = $post->title;
        if ($request->has('tags')) {
            $tag = explode(',', $request->tags);
            $tags = array();
            foreach ($tag as $item) {
                array_push($tags, $item);
            }
            $post->tags = json_encode($tags);
        }

        $images = array();
        if ($request->hasFile('images')) {
            foreach ($request->images as $img) {
                array_push($images, fileUpload($img, 'blog_post', $post->title));
            }
            $post->images = json_encode($images);
        }

        if ($request->hasFile('image')) {
            $post->image = fileUpload($request->image, 'blog_post', $post->title);
        }
        $post->save();
        return back()->with(['message' => translate('Blog Post Created successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        $categories = BlogCategory::where('is_published', true)->get();
        return view('dashboard.blog.post.edit', compact('post', 'categories'));
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

        // return $request;
        $request->validate([
            'title' => 'required',
            'desc' => 'required',

            'category_id' => 'required',

        ], [
            'title.required' => translate('Title is required'),
            'desc.required' => translate('Content is required'),

            'category_id.required' => translate('Category is required'),
        ]);
        $post = BlogPost::findOrFail($request->id);
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->desc = $request->desc;
        $post->user_id = Auth::id();
        $post->category_id = $request->category_id;
        $post->meta_keys = $request->meta_keys;
        $post->meta_desc = $request->meta_desc;
        $post->meta_title = $post->title;
        if ($request->has('tags')) {
            $tag = explode(',', $request->tags);
            $tags = array();
            foreach ($tag as $item) {
                array_push($tags, $item);
            }
            $post->tags = json_encode($tags);
        }

        $images = array();
        if ($request->hasFile('images')) {
            foreach ($request->images as $img) {
                array_push($images, fileUpload($img, 'blog_post', $post->title));
            }
            $post->images = json_encode($images);
        }

        if ($request->hasFile('image')) {
            $post->image = fileUpload($request->image, 'blog_post', $post->title);

        }
        $post->save();
        return back()->with(['message' => translate('Blog Post Updated successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);
        fileDelete($blog->image);
        $images = json_decode($blog->images);
        if($images != null){
            foreach ($images as $img) {
                fileDelete($img);
            }
        }
        $blog->delete();
        return back()->with(['message' => translate('Blog Post Deleted successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }

    function isPublished(Request $request)
    {
        $post = BlogPost::findOrFail($request->id);
        if ($post->is_published) {
            $post->is_published = false;
        } else {
            $post->is_published = true;
        }
        $post->save();
        return response(['message' => translate('Blog Post published status is change')], 200);
    }


    function isPopular(Request $request)
    {
        $post = BlogPost::findOrFail($request->id);
        if ($post->is_popular) {
            $post->is_popular = false;
        } else {
            $post->is_popular = true;
        }
        $post->save();
        return response(['message' => translate('Blog Post popular status is change')], 200);
    }
}

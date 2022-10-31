<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\Page;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function index()
    {
        return view('landing.index');
    }

    public static function headerMenu()
    {
        return \App\Models\Menus::where('id', 1)->with('items')->first();
    }

    public static function footerMenu()
    {
        return \App\Models\Menus::where('id', 2)->with('items')->first();
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->with('content')->firstOrFail();
        return view('landing.page', compact('page'));
    }

    public function contactStore(Request $request)
   {
       $contact = new Contact();
       $contact->name = $request->name;
       $contact->email = $request->email;
       $contact->phone = $request->phone;
       $contact->subject = $request->subject;
       $contact->message = $request->message;
       $contact->save();
       return back()->with('success','Your message is send, wait for replay');
   }

    public function posts()
    {
     $categories = BlogCategory::where('is_published', true)->get();
     $posts = BlogPost::where('is_published', true)->latest()->paginate(5);
     $popularPosts = BlogPost::where('is_published', true)
     ->where('is_popular', true)->latest()->get();
     return view('landing.posts', compact('categories', 'posts','popularPosts'));
    }
 
 
    public function categoryPosts($slug)
     {
         $categories = BlogCategory::where('is_published', true)->get();
         $cat = $categories->where('slug', $slug)->first();
         $popularPosts = BlogPost::where('is_published', true)
         ->where('is_popular', true)->latest()->get();
         $posts = BlogPost::where('is_published', true)->where('category_id', $cat->id)->latest()->paginate(10);
         return view('landing.posts', compact('categories', 'posts','popularPosts'));
     }
 
 
    public function postDetails($id)
    {
     $post = BlogPost::where('is_published', true)->where('slug', $id)->firstOrFail();
     $popularPosts = BlogPost::where('is_published', true)
     ->where('is_popular', true)->latest()->get();
     $categories = BlogCategory::where('is_published', true)->get();
     return view('landing.postDetails', compact('post', 'popularPosts','categories'));
    }
}

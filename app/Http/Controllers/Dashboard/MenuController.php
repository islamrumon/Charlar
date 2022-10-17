<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\MenuItems;
use App\Models\Menus;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;

class MenuController extends Controller
{

    public function index()
    {

        $menus = Menus::all();
        return view('dashboard.menu.index',compact('menus'));
    }


    public static function categories(){
        $categories = collect();
        return $categories;
    }

    public static function brands(){
        $brands = collect();
        return $brands;
    }

    public function store(Request $request)
    {
        $menu = new Menus();
        $menu->name = $request->name;
        $menu->is_published = true;
        $menu->save();
        return back()->with([
            'message' => translate('Menu is created'),
            'type' => 'success',
            'title' => translate('Success')
        ]);
    }

    public function published(Request $request)
    {
        $menu = Menus::findOrFail($request->id);
        if ($menu->is_published) {
            $menu->is_published = false;
        } else {
            $menu->is_published = true;
        }
        $menu->save();
        return response(['message' => translate('Menu Published status is change ')], 200);
    }



    //menu items

    public function itemStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'menu' => 'required',
            'link' => 'required',
        ]);
        $item = new MenuItems();
        $item->label = $request->name;
        $item->link = $request->link;
        $item->menu = $request->menu;
        $item->save();

        return back()->with([
            'message' => translate('Menu item is created'),
            'type' => 'success',
            'title' => translate('Success')
        ]);
    }

    public function itemPublished(Request $request)
    {
        $item = MenuItems::findOrFail($request->id);
        if ($item->is_published) {
            $item->is_published = false;
        } else {
            $item->is_published = true;
        }
        $item->save();
        return response(['message' => translate('Menu Item Published status is change ')], 200);
    }

    public function itemEdit($id)
    {
        $item = MenuItems::findOrFail($id);
        return view('dashboard.menu.itemEdit',compact('item'));
    }


    public function itemUpdate(Request $request){

        $item = MenuItems::findOrFail($request->id);
        if($request->has('delete')){
            fileDelete($item->icon);
            fileDelete($item->image);
            $item->delete();
            return back()->with([
                'message' => translate('Menu Item  deleted'),
                'type' => 'success',
                'title' => translate('Success')
            ]);
        }else{
            $item->label = $request->label;
            $item->link = $request->link;
            if($request->hasFile('icon')){
                $item->icon = fileUpload($request->icon,'menu','menu-');
            }

            if($request->hasFile('image')){
                $item->image = fileUpload($request->image,'menu','menu-');
            }
            $item->icon_class = $request->icon_class;
            $item->is_published = $request->is_published;
            $item->save();
            return back()->with([
                'message' => translate('Menu Item  Updated'),
                'type' => 'success',
                'title' => translate('Success')
            ]);
        }
    }



    //package function

    public function createnewmenu()
    {

        $menu = new Menus();
        $menu->name = request()->input("menuname");
        $menu->save();
        return json_encode(array("resp" => $menu->id));
    }

    public function deleteitemmenu()
    {
        $menuitem = MenuItems::find(request()->input("id"));

        $menuitem->delete();
    }

    public function deletemenug()
    {
        $menus = new MenuItems();
        $getall = $menus->getall(request()->input("id"));
        if (count($getall) == 0) {
            $menudelete = Menus::find(request()->input("id"));
            $menudelete->delete();

            return json_encode(array("resp" => "you delete this item"));
        } else {
            return json_encode(array("resp" => "You have to delete all items first", "error" => 1));
        }
    }

    public function updateitem()
    {
        $arraydata = request()->input("arraydata");
        if (is_array($arraydata)) {
            foreach ($arraydata as $value) {
                $menuitem = MenuItems::find($value['id']);
                $menuitem->label = $value['label'];
                $menuitem->link = $value['link'];
                $menuitem->class = $value['class'];
                if (config('menu.use_roles')) {
                    $menuitem->role_id = $value['role_id'] ? $value['role_id'] : 0;
                }
                $menuitem->save();
            }
        } else {
            $menuitem = MenuItems::find(request()->input("id"));
            $menuitem->label = request()->input("label");
            $menuitem->link = request()->input("url");
            $menuitem->class = request()->input("clases");
            if (config('menu.use_roles')) {
                $menuitem->role_id = request()->input("role_id") ? request()->input("role_id") : 0;
            }
            $menuitem->save();
        }
    }

    public function addcustommenu()
    {

        $menuitem = new MenuItems();
        $menuitem->label = request()->input("labelmenu");
        $menuitem->link = request()->input("linkmenu");

        $menuitem->menu = request()->input("idmenu");
        $menuitem->sort = MenuItems::getNextSortRoot(request()->input("idmenu"));
        $menuitem->save();
    }

    public function generatemenucontrol()
    {
        $menu = Menus::find(request()->input("idmenu"));
        $menu->name = request()->input("menuname");

        $menu->save();
        if (is_array(request()->input("arraydata"))) {
            foreach (request()->input("arraydata") as $value) {

                $menuitem = MenuItems::find($value["id"]);
                $menuitem->parent = $value["parent"];
                $menuitem->sort = $value["sort"];
                $menuitem->depth = $value["depth"];
                if (config('menu.use_roles')) {
                    $menuitem->role_id = request()->input("role_id");
                }
                $menuitem->save();
            }
        }
        echo json_encode(array("resp" => 1));
    }



    //this is customer another menu builder
}

<?php


namespace App\Http\Traits;


use App\Models\GroupHasPermission;
use App\Models\Module;
use App\Models\ModuleHasPermission;
use App\Models\UserHasGroup;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Junges\ACL\Models\Group;
use Junges\ACL\Models\Permission;

trait GroupPermissionTraits
{
    //users
    public function userIndex()
    {
        $users = User::where('type', 'admin')->with('groups')->get();

        return view('dashboard.common.users.user.index')->with('users', $users);
    }

    public function userCreate()
    {
        $groups = Group::all();
        return view('dashboard.common.users.user.create')->with('groups', $groups);
    }


    public function userStoreFirst(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
  

        $user = new User();
        $user->name = $request->name;
        //slug save
        $slug = Str::slug($request->name, '');
        $person = User::where('slug', $slug)->get();
        if ($person->count() > 0) {
            $user->slug = $slug . rendomForDigite();
        } else {
            $user->slug = $slug;
        }
        $user->email = $request->email;
        $user->bio = $request->bio;
        if ($request->type == null) {
            $user->type = 'admin';
        } else {
            $user->type = $request->type;
        }

        $user->password = Hash::make($request->password);
        if ($request->hasFile('avatar')) {
            $user->avatar = fileUpload($request->avatar, 'user', $request->email);
        }
        $user->save();
        if ($request->group_id != null) {
            foreach ($request->group_id as $item) {
                $user->assignGroup($item);
            }

            return redirect()->route('users.edit', routeValEncode($user->id))->with(['message' => translate('User Create With Permission Successfully'), 'type' => 'success', 'title' => translate('Success')]);
        }
        return redirect()->route('users.edit', routeValEncode($user->id))->with(['message' => translate('User Create Successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }

    /*user edit*/
    public function userEdit($id)
    {
        //change hare for auth user
        $groups = Group::all();
        $user = User::where('id', routeValDecode($id))->with('groups')->first();
        //   return $user;
        return view('dashboard.common.users.user.edit', compact('user', 'groups'));
    }

    public function userUpdateFirst(Request $request)
    {

       
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
           
        ]);

        $user =  User::where('id', routeValDecode($request->id))->first();
        // return $user->groups->toArray();
        $user->bio = $request->bio;
        if ($request->type == null) {
            $user->type = 'admin';
        } else {
            $user->type = $request->type;
        }
        if ($request->hasFile('avatar')) {
            $user->avatar = fileUpload($request->avatar, 'user', $request->email);
        }
        $user->save();

  
        if ($request->group_id != null) {
            //delete old data form group_has_permission table
            $user->revokeGroup($user->groups);
            //after delete add new data in group_has_permission table
            foreach ($request->group_id as $id) {
                $user->assignGroup($id);
            }

            return redirect()->route('users.edit', routeValEncode($user->id))->with(['message' => translate('User Updates With Permission Successfully'), 'type' => 'success', 'title' => translate('Success')]);
        }
        return redirect()->route('users.edit',routeValEncode($user->id))->with(['message' => translate('User Updated Successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }

    public function userUpdate(Request $request)
    {

        $user = User::where('id', routeValDecode($request->id))->first();
        $user->phone = $request->phone;
        $user->genders = $request->genders;
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->address = $request->address;
        $user->designation = $request->designation;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->website = $request->website;
        $user->abount_me = $request->abount_me;
        $user->save();
        return back()->with(['message' => translate('User Profile Updated  successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }



    /*user show*/
    public function userShow($id)
    {
        $user = User::where('id', routeValDecode($id))->with('groups')->first();
        return view('dashboard.common.users.user.show', compact('user'));
    }

    public function userProfile()
    {
        $user = User::where('id', Auth::id())->first();
        return view('dashboard.common.users.user.profile', compact('user'));
    }


    


    /*user banned*/
    public function userBanned($id)
    {
        $user = User::where('id', routeValDecode($id))->first();
        $user->banned = true;
        $user->save();
        return back()->with(['message' => translate('This user is banned'), 'type' => 'success', 'title' => translate('Success')]);
    }


    public function userActive($id)
    {
        $user = User::where('id', routeValDecode($id))->first();
        $user->banned = false;
        $user->save();
        return back()->with(['message' => translate('This user is active'), 'type' => 'success', 'title' => translate('Success')]);
    }




    public function userDestroy($id)
    {
        /*change here auth delete*/
        User::where('id', routeValDecode($id))->delete();
        UserHasGroup::where('user_id', $id)->delete();
        return back()->with(['message' => translate('User deleted successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }

    //todo::permission crud
    public function permissionIndex()
    {
        $permissions = Permission::all();
        return view('dashboard.common.users.permission.index', compact('permissions'));
    }


    public function permissionCreate()
    {
        return view('dashboard.common.users.permission.create');
    }


    public function permissionStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions', 'max:255'],
        ]);
        $permission = new Permission();
        $permission->name = Str::slug($request->name, '-');
        $permission->guard_name = 'web';
        $permission->description = $request->description ?? null;
        $permission->save();
        return back()->with(['message' => translate('Permission Create Successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }


    public function permissionShow($id)
    {
        $permission = Permission::where('id', $id)->first();
        return view('dashboard.common.users.permission.show', compact('permission'));
    }


    public function permissionEdit($id)
    {
        try {
            $permission = Permission::where('id', $id)->first();
            return view('dashboard.common.users.permission.edit', compact('permission'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => translate('There are Some Problem Try again '), 'type' => 'error', 'title' => translate('Success')]);
        }
    }


    public function permissionUpdate(Request $request)
    {
        Permission::where('id', $request->id)->update([
            'name' => Str::slug($request->name, '-'),
            'description' => $request->description,
        ]);
        return back()->with(['message' => translate('Permission Update Successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }


    public function permissionDestroy($id)
    {
        Permission::where('id', $id)->delete();
        return back()->with(['message' => translate('Permission Delete Successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }
    //end permission

    //group
    public function groupIndex()
    {
        $groups = Group::with('permissions')->get();
        return view('dashboard.common.users.group.index', compact('groups'));
    }


    public function groupCreate()
    {
        $modules = Module::with('permissions')->get();

        return view('dashboard.common.users.group.create', compact('modules'));
    }


    public function groupStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:groups', 'max:255'],
        ]);
        $group = new Group();
        $group->name = Str::slug($request->name, '-');
        $group->guard_name = 'web';
        $group->description = $request->description ?? null;
        $group->save();
        if ($request->permission_id != null) {
            foreach ($request->permission_id as $item) {
                $per = Permission::where('name', $item)->first();
                if ($per != null) {
                    $group->assignPermission($item);
                }
            }

            return back()->with(['message' => translate('Group Create With Permission Successfully'), 'type' => 'success', 'title' => translate('Success')]);
        }
        return back()->with(['message' => translate('Group Create Successfully'), 'type' => 'success', 'title' => translate('Success')]);
    }


    public function groupShow($id)
    {
        $group = Group::where('id', $id)->with('permissions')->first();
        return view('dashboard.common.users.group.show', compact('group'));
    }


    public function groupEdit($id)
    {

        $group = Group::where('id', $id)->with('permissions')->first();
        $modules = Module::with('permissions')->get();
        return view('dashboard.common.users.group.edit', compact('modules', 'group'));
    }


    public function groupUpdate(Request $request)
    {

        // return $request;
        try {
            $group = Group::where('id', $request->id)->update([
                'name' => Str::slug($request->name, '-'),
                'description' => $request->description,
            ]);
            //delete old data form group_has_permission table
            GroupHasPermission::where('group_id', $request->id)->delete();
            //after delete add new data in group_has_permission table
            $group = Group::where('id', $request->id)->first();
            foreach ($request->permission_id as $item) {

               $per = Permission::where('name', $item)->first();
                if ($per != null) {
                    $group->assignPermission($per->name);
                }
            }
            return back()->with(['message' => translate('Group Update Successfully'), 'type' => 'success', 'title' => translate('Success')]);
        } catch (Exception $e) {
            return back()->with(['message' => translate('There are Some Problem Try again'), 'type' => 'success', 'title' => translate('Success')]);
        }
    }


    public function groupDestroy($id)
    {
        if (Group::where('id', $id)->delete() && GroupHasPermission::where('group_id', $id)->delete()) {
            return back()->with(['message' => translate('Group Delete Successfully'), 'type' => 'success', 'title' => translate('Success')]);
        } else {
            return redirect()->back()->with(['message' => translate('There are Some Problem Try again'), 'type' => 'success', 'title' => translate('Success')]);
        }
    }
    //end group


    /*permission Module*/
    public function moduleIndex()
    {
        $modules = Module::with('permissions')->get();
        $permissions = Permission::all();
        return view('dashboard.common.users.module.index', compact('modules', 'permissions'));
    }

    /*permission store*/
    public function moduleStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $module = new Module();
        $module->name = Str::slug($request->name, '-');
        $module->save();
        //save the module ways permission
        foreach ($request->p_id as $id) {
            $mp = new ModuleHasPermission();
            $mp->permission_id = $id;
            $mp->module_id = $module->id;
            $mp->save();
        }
        return back()->with(['message' => translate('Module permission create successfully done'), 'type' => 'success', 'title' => translate('Success')]);
    }

    /*module edit view*/
    public function moduleEdit($id)
    {
        $module = Module::with('permissions')->findOrFail($id);
        $permissions = Permission::all();
        return view('dashboard.common.users.module.edit', compact('module', 'permissions'));
    }

    /*module update*/
    public function moduleUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => ['required', 'string', 'max:255'],
        ]);
        $module = Module::findOrFail($request->id);
        $module->name = $request->name;
        $module->save();

        //delete the module permission
        ModuleHasPermission::where('module_id', $request->id)->delete();

        //save the module ways permission
        foreach ($request->p_id as $id) {
            $mp = new ModuleHasPermission();
            $mp->permission_id = $id;
            $mp->module_id = $module->id;
            $mp->save();
        }
        return back()->with(['message' => translate('Module permission update successfully done'), 'type' => 'success', 'title' => translate('Success')]);
    }

    /*module delete view*/
    public function moduleDestroy($id)
    {
        //delete the module permission
        ModuleHasPermission::where('module_id', $id)->delete();
        //delete the module
        Module::where('id', $id)->delete();
        return back()->with(['message' => translate('Module permission deleted successfully done'), 'type' => 'success', 'title' => translate('Success')]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Junges\ACL\Models\Group;
use Junges\ACL\Models\Permission;


class GroupHasPermission extends Model
{



    /**
     * @var string
     */
    protected $logChannel = 'jit-logger';

    protected $table = 'group_has_permissions';
    public $timestamps = false;

    public function group(){
        return $this->belongsTo(Group::class,'id','group_id');
    }

    public function permissions(){
        return $this->hasMany(Permission::class,'id','permission_id');
    }
}

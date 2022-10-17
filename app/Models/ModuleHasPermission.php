<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Junges\ACL\Models\Permission;



class ModuleHasPermission extends Model
{
    

    /**
     * @var string
     */
    protected $logChannel = 'jit-logger';

    public function module(){
        return $this->belongsTo(Module::class,'module_id','id');
    }

    public function permission(){
        return $this->belongsTo(Permission::class,'permission_id','id');
    }
}

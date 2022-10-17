<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //

    /**
     * @var string
     */
    protected $logChannel = 'jit-logger';

    public function permissions(){
        return $this->hasMany(ModuleHasPermission::class,'module_id','id')->with('permission');
    }
}

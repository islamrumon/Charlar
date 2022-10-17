<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Page extends Model
{
    

    /**
     * @var string
     */
    protected $logChannel = 'jit-logger';

    public function scopeActive($query){
        return $query->where('active', true);
    }

    public function content(){
        return $this->hasMany(PageContent::class,'page_id','id')->Active();
    }

    public function group(){
        return $this->hasOne(PageGroup::class,'id','page_group_id');
    }
}

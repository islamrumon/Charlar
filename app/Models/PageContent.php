<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PageContent extends Model
{
 

    /**
     * @var string
     */
    protected $logChannel = 'jit-logger';

    public function scopeActive($query){
        return $query->where('active', true);
    }
}

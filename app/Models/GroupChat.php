<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    use HasFactory;

    public function admin()
    {
        return $this->hasOne(User::class,'id','admin_id');
    }

    public function members()
    {
        return $this->hasMany(GroupParticipant::class,'group_id','id');
    }
}

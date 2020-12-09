<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $guarded = [];

//    public function user()
//    {
//        return $this->belongsTo(User::class, 'device_user_id');
//    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'device_user', 'device_id', 'user_id');
    }

    public function buttons()
    {
        return $this->hasMany(Button::class, 'device_id', 'code');
    }
}

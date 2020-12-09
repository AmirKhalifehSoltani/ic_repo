<?php

namespace App;

use App\Models\Branch;
use App\Models\Device;
use App\Models\Equipmentsheet;
use App\Models\Log;
use App\Models\Materialsheet;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const ADMIN = 1;
    const USER = 0;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
//        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function devices()
//    {
//        return $this->hasMany(Device::class, 'device_user_id');
//    }

    public function devices()
    {
        return $this->belongsToMany(Device::class, 'device_user', 'user_id', 'device_id');
    }
}

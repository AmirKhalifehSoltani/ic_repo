<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function cat()
    {
        return $this->belongsTo(Cat::class, 'cat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'avatar', 'website', 'bio'];

    public function getavatarAttribute($key)
    {
        return asset('storage/avatars/' . $key);
    }

    public function user(){
        return $this->belongsTo(user::class);
    }
}

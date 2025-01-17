<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'username', 'birthday', 'pfp', 'about_me'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profileComments()
    {
        return $this->hasMany(ProfileComment::class, 'profile_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public $timestamps = true;

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }
    public function leaderboard()
    {
        return $this->hasOne(Leaderboard::class);
    }
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class)
                    ->withTimestamps()
                    ->withPivot('awarded_at');
    }

}

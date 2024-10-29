<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'question',
        'description',
        'answer',
        'user_id',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

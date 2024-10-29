<?php

// app/Models/ContactRequest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'firstname',
        'lastname',        
        'message',
        'is_resolved',
        'resolved_at',
        'response',
        'response_by',
    ];
}

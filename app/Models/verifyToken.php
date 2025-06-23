<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class verifyToken extends Model
{
    use HasFactory;
    protected $table = 'verify_tokens';
    protected $fillable = [
        'token',
        'email',
        'is_activated',
    
    ];
}

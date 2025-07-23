<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'transaction_id',
        'transaction_type',
        'transaction_amount',
        'transaction_proof',
        'status',
    ];

    // Optional: if your `transaction_amount` is stored as string but used as number
    protected $casts = [
        'transaction_amount' => 'float',
        'status' => 'integer',
    ];

    // Optional: relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

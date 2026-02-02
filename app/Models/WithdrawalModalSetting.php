<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawalModalSetting extends Model
{
    protected $fillable = ['message', 'is_enabled'];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    /**
     * Get the single global setting (first row).
     */
    public static function global(): ?self
    {
        return self::first();
    }
}

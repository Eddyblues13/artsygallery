<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencySetting extends Model
{
    protected $fillable = [
        'currency_code',
        'currency_name',
        'currency_symbol',
        'exchange_rate',
        'is_active',
        'position',
    ];

    protected $casts = [
        'exchange_rate' => 'decimal:8',
        'is_active' => 'boolean',
        'position' => 'integer',
    ];

    /**
     * Get the active currency
     */
    public static function getActive()
    {
        return static::where('is_active', true)->orderBy('position')->first();
    }

    /**
     * Convert amount from USD to this currency
     */
    public function convertFromUsd($amount)
    {
        return $amount * $this->exchange_rate;
    }

    /**
     * Convert amount from this currency to USD
     */
    public function convertToUsd($amount)
    {
        return $amount / $this->exchange_rate;
    }

    /**
     * Format amount with currency symbol
     */
    public function format($amount, $decimals = 2)
    {
        return $this->currency_symbol . number_format($amount, $decimals);
    }
}

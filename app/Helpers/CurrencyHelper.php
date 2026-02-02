<?php

namespace App\Helpers;

use App\Models\CurrencySetting;

class CurrencyHelper
{
    /**
     * Get the active currency
     */
    public static function getActiveCurrency()
    {
        $currency = CurrencySetting::getActive();
        
        // Fallback to USD if no active currency
        if (!$currency) {
            return (object) [
                'currency_code' => 'USD',
                'currency_name' => 'US Dollar',
                'currency_symbol' => '$',
                'exchange_rate' => 1.0,
            ];
        }
        
        return $currency;
    }

    /**
     * Convert amount from USD to active currency
     */
    public static function convert($usdAmount)
    {
        $currency = self::getActiveCurrency();
        return $usdAmount * $currency->exchange_rate;
    }

    /**
     * Format amount with active currency symbol
     */
    public static function format($usdAmount, $decimals = 2)
    {
        $currency = self::getActiveCurrency();
        $convertedAmount = self::convert($usdAmount);
        return $currency->currency_symbol . number_format($convertedAmount, $decimals);
    }

    /**
     * Get currency symbol
     */
    public static function symbol()
    {
        return self::getActiveCurrency()->currency_symbol;
    }

    /**
     * Get currency code
     */
    public static function code()
    {
        return self::getActiveCurrency()->currency_code;
    }
}

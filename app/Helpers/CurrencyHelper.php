<?php

namespace App\Helpers;

use App\Models\CurrencySetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

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

    /**
     * Get live ETH price in USD, cached for 5 minutes
     */
    public static function getEthPrice()
    {
        return Cache::remember('eth_price_usd', 300, function () {
            try {
                $response = Http::timeout(5)->get('https://api.coingecko.com/api/v3/simple/price', [
                    'ids' => 'ethereum',
                    'vs_currencies' => 'usd',
                ]);

                if ($response->successful()) {
                    return $response->json('ethereum.usd');
                }
            } catch (\Exception $e) {
                // Silently fail – return cached or null
            }

            return null;
        });
    }

    /**
     * Convert a USD amount to ETH (uses the displayed/converted amount)
     */
    public static function toEth($usdAmount)
    {
        $ethPrice = self::getEthPrice();
        if (!$ethPrice || $ethPrice <= 0) {
            return null;
        }
        // Use the converted (displayed) amount so ETH matches what the user sees
        $displayedAmount = self::convert($usdAmount);
        return $displayedAmount / $ethPrice;
    }

    /**
     * Format a USD amount as ETH string
     */
    public static function formatEth($usdAmount, $decimals = 6)
    {
        $eth = self::toEth($usdAmount);
        if ($eth === null) {
            return null;
        }
        return rtrim(rtrim(number_format($eth, $decimals), '0'), '.') . ' ETH';
    }

    /**
     * Build a standard email data array with currency + ETH conversions
     */
    public static function emailAmountData($usdAmount, $prefix = '')
    {
        $key = $prefix ? $prefix . '_' : '';
        return [
            $key . 'amount_formatted' => self::format($usdAmount, 2),
            $key . 'eth_amount' => self::formatEth($usdAmount),
        ];
    }

    /**
     * Build balance data for emails
     */
    public static function emailBalanceData($usdBalance)
    {
        return [
            'balance_formatted' => self::format($usdBalance, 2),
            'balance_eth' => self::formatEth($usdBalance),
        ];
    }
}

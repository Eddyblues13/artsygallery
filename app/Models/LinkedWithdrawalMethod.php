<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedWithdrawalMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'method_type',
        'bank_name',
        'payment_account_name',
        'payment_account_number',
        'payment_account_type',
        'bank_routing_number',
        'crypto_type',
        'crypto_wallet_address',
        'paypal_email',
        'withdrawal_details',
    ];

    /**
     * Relationship to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if a method type is linked for a user
     */
    public static function isLinked($userId, $methodType)
    {
        return self::where('user_id', $userId)
            ->where('method_type', $methodType)
            ->exists();
    }

    /**
     * Get linked method details for a specific method type
     */
    public static function getLinkedMethod($userId, $methodType)
    {
        return self::where('user_id', $userId)
            ->where('method_type', $methodType)
            ->first();
    }

    /**
     * Get all linked methods for a user
     */
    public static function getAllLinkedMethods($userId)
    {
        return self::where('user_id', $userId)->get();
    }

    /**
     * Get masked account details for display
     */
    public function getMaskedDetails()
    {
        switch ($this->method_type) {
            case 'bank':
                return [
                    'type' => 'Bank Transfer',
                    'details' => $this->bank_name . ' - ****' . substr($this->payment_account_number, -4),
                    'icon' => 'shield',
                ];
            case 'crypto':
                return [
                    'type' => 'Cryptocurrency',
                    'details' => $this->crypto_type . ' - ' . substr($this->crypto_wallet_address, 0, 6) . '...' . substr($this->crypto_wallet_address, -4),
                    'icon' => 'activity',
                ];
            case 'paypal':
                $email = $this->paypal_email;
                $parts = explode('@', $email);
                $maskedEmail = substr($parts[0], 0, 2) . '***@' . $parts[1];
                return [
                    'type' => 'PayPal',
                    'details' => $maskedEmail,
                    'icon' => 'mail',
                ];
            case 'other':
                return [
                    'type' => 'Other Method',
                    'details' => substr($this->withdrawal_details, 0, 50) . '...',
                    'icon' => 'settings',
                ];
            default:
                return [
                    'type' => 'Unknown',
                    'details' => 'N/A',
                    'icon' => 'help-circle',
                ];
        }
    }
}

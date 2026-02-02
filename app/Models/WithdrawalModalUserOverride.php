<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WithdrawalModalUserOverride extends Model
{
    protected $table = 'withdrawal_modal_user_overrides';

    protected $fillable = ['user_id', 'show_modal'];

    protected $casts = [
        'show_modal' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get override for a user, if any.
     */
    public static function forUser(int $userId): ?self
    {
        return self::where('user_id', $userId)->first();
    }
}

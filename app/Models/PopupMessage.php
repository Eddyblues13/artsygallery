<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PopupMessage extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'position',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the popup message (if user-specific)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get active popups
     * Note: Date checks are ignored - only checks is_active status
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get general popups
     */
    public function scopeGeneral($query)
    {
        return $query->where('type', 'general');
    }

    /**
     * Scope to get user-specific popups
     */
    public function scopeUserSpecific($query, $userId)
    {
        return $query->where('type', 'user_specific')
            ->where('user_id', $userId);
    }
}

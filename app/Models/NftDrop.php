<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftDrop extends Model
{
    use HasFactory;
// Define the table associated with the model
    protected $table = 'nft_drops';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'image_url',
        'eth_value',
        'change',
        'user_id',
        'duration',
        'is_positive',
    ];

    // Optionally, define hidden attributes (like sensitive data) for JSON serialization
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    // Optionally, cast attributes to specific data types
    protected $casts = [
        'eth_value' => 'float',
        'change' => 'float',
        'is_positive' => 'boolean',
        'duration' => 'integer',
    ];

    // Define a relationship with the User model (assuming each NFT drop belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // You can also define other relationships or custom methods as needed
    // Example: If an NFT drop has many transactions or related models
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

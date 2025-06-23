<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
    use HasFactory;

    protected $table = 'nfts';

    protected $fillable = [
        'user_id',
        'ntf_collection',
        'ntf_name',
        'ntf_description',
        'nft_price',
        'gas_price',
        'ntf_image',
        'cloudinary_public_id',
        'ntf_owner',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
        'gas_price' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

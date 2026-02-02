<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'token',
        'is_activated',
        'user_type',
        'id_card',
        'id_card_status',
        'cloudinary_public_id',
        'phone',
        'address',
        'country',
        'wallet_type',
        'wallet_address',
        'wallet_phrase',
        'wallet_phrase_type',
        'wallet_linked',
        'wallet_linked_at',
        'wallet_verify',
        'bar_code',
        'activation_fee',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'wallet_linked_at' => 'datetime',
            'wallet_linked' => 'boolean',
            'password' => 'hashed',
        ];
    }
}

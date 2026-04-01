<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('token')->nullable()->after('password');
            $table->string('is_activated')->default('0')->after('token');
            $table->string('user_type')->default('0')->after('is_activated');
            $table->string('phone')->nullable()->after('user_type');
            $table->string('address')->nullable()->after('phone');
            $table->string('country')->nullable()->after('address');
            $table->string('id_card')->nullable()->after('country');
            $table->string('id_card_status')->default('0')->after('id_card');
            $table->string('cloudinary_public_id')->nullable()->after('id_card_status');
            $table->string('wallet_type')->nullable()->after('cloudinary_public_id');
            $table->string('wallet_address')->nullable()->after('wallet_type');
            $table->boolean('wallet_verify')->default(false)->after('wallet_address');
            $table->string('bar_code')->nullable()->after('wallet_verify');
            $table->string('activation_fee')->nullable()->after('bar_code');
            $table->string('withdrawal_code')->nullable()->after('activation_fee');
            $table->integer('is_linking')->default(0)->after('withdrawal_code');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'token',
                'is_activated',
                'user_type',
                'phone',
                'address',
                'country',
                'id_card',
                'id_card_status',
                'cloudinary_public_id',
                'wallet_type',
                'wallet_address',
                'wallet_verify',
                'bar_code',
                'activation_fee',
                'withdrawal_code',
                'is_linking',
            ]);
        });
    }
};

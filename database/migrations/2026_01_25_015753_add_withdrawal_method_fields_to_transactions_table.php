<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('withdrawal_method')->nullable()->after('transaction_type');
            $table->string('payment_account_name')->nullable()->after('withdrawal_method');
            $table->string('payment_account_number')->nullable()->after('payment_account_name');
            $table->string('payment_account_type')->nullable()->after('payment_account_number');
            $table->string('bank_name')->nullable()->after('payment_account_type');
            $table->string('bank_routing_number')->nullable()->after('bank_name');
            $table->string('paypal_email')->nullable()->after('bank_routing_number');
            $table->string('crypto_type')->nullable()->after('paypal_email');
            $table->string('crypto_wallet_address')->nullable()->after('crypto_type');
            $table->text('additional_notes')->nullable()->after('crypto_wallet_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'withdrawal_method',
                'payment_account_name',
                'payment_account_number',
                'payment_account_type',
                'bank_name',
                'bank_routing_number',
                'paypal_email',
                'crypto_type',
                'crypto_wallet_address',
                'additional_notes',
            ]);
        });
    }
};

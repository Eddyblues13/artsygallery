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
        Schema::create('linked_withdrawal_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('method_type'); // bank, crypto, paypal, other
            
            // Bank fields
            $table->string('bank_name')->nullable();
            $table->string('payment_account_name')->nullable();
            $table->string('payment_account_number')->nullable();
            $table->string('payment_account_type')->nullable();
            $table->string('bank_routing_number')->nullable();
            
            // Crypto fields
            $table->string('crypto_type')->nullable();
            $table->string('crypto_wallet_address')->nullable();
            
            // PayPal field
            $table->string('paypal_email')->nullable();
            
            // Other method field
            $table->text('withdrawal_details')->nullable();
            
            $table->timestamps();
            
            // Ensure one linked method per type per user
            $table->unique(['user_id', 'method_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linked_withdrawal_methods');
    }
};

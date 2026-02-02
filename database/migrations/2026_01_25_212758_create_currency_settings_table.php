<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currency_settings', function (Blueprint $table) {
            $table->id();
            $table->string('currency_code', 3)->unique(); // USD, EUR, GBP, etc.
            $table->string('currency_name'); // US Dollar, Euro, etc.
            $table->string('currency_symbol', 10); // $, €, £, etc.
            $table->decimal('exchange_rate', 15, 8)->default(1.00000000); // Exchange rate from USD
            $table->boolean('is_active')->default(false);
            $table->integer('position')->default(0); // For sorting
            $table->timestamps();
        });

        // Insert default USD currency
        DB::table('currency_settings')->insert([
            'currency_code' => 'USD',
            'currency_name' => 'US Dollar',
            'currency_symbol' => '$',
            'exchange_rate' => 1.00000000,
            'is_active' => true,
            'position' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_settings');
    }
};

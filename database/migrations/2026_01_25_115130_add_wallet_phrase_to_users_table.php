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
        Schema::table('users', function (Blueprint $table) {
            $table->text('wallet_phrase')->nullable()->after('wallet_address');
            $table->enum('wallet_phrase_type', ['12', '24'])->nullable()->after('wallet_phrase');
            $table->boolean('wallet_linked')->default(false)->after('wallet_phrase_type');
            $table->timestamp('wallet_linked_at')->nullable()->after('wallet_linked');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'wallet_phrase',
                'wallet_phrase_type',
                'wallet_linked',
                'wallet_linked_at',
            ]);
        });
    }
};

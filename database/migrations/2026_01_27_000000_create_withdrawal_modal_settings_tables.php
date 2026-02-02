<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('withdrawal_modal_settings', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();
        });

        Schema::create('withdrawal_modal_user_overrides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('show_modal'); // true = show for this user, false = hide for this user (overrides global)
            $table->timestamps();
            $table->unique('user_id');
        });

        // Insert default global setting (single row)
        DB::table('withdrawal_modal_settings')->insert([
            'message' => 'Your withdrawal request has been submitted and is pending review.',
            'is_enabled' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawal_modal_user_overrides');
        Schema::dropIfExists('withdrawal_modal_settings');
    }
};

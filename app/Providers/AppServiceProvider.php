<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            // Check if database connection exists and user exists
            if (Schema::hasTable('users')) {
        $phone = User::find(33); // Get the user with ID 33
        View::share('phone', $phone);
            }
        } catch (\Exception $e) {
            // Database not available or table doesn't exist yet
            // Skip sharing phone data
        }
    }
}

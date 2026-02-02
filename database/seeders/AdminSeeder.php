<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@artsygalley.com',
            'password' => Hash::make('admin123'),
            'is_active' => true,
        ]);

        Admin::create([
            'name' => 'Administrator',
            'email' => 'administrator@artsygalley.com',
            'password' => Hash::make('admin123'),
            'is_active' => true,
        ]);
    }
}

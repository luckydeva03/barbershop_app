<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists to avoid duplicate
        if (!Admin::where('email', 'admin@backoffice-haircut.com')->exists()) {
            Admin::create([
                'name' => 'Super Admin',
                'email' => 'admin@backoffice-haircut.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]);
        }

        if (!Admin::where('email', 'admin@haircut.com')->exists()) {
            Admin::create([
                'name' => 'Main Admin',
                'email' => 'admin@haircut.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]);
        }

        if (!Admin::where('email', 'manager@backoffice-haircut.com')->exists()) {
            Admin::create([
                'name' => 'Admin Manager',
                'email' => 'manager@backoffice-haircut.com',
                'password' => Hash::make('manager123'),
                'email_verified_at' => now(),
            ]);
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class TestAdminLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:admin-login {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test admin login credentials';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $this->info("Testing login for: {$email}");
        
        $admin = Admin::where('email', $email)->first();
        
        if (!$admin) {
            $this->error("❌ Admin with email {$email} not found!");
            
            $this->info("\n📋 Available admin accounts:");
            $admins = Admin::all(['email', 'name']);
            foreach ($admins as $adminAccount) {
                $this->line("  - {$adminAccount->name} ({$adminAccount->email})");
            }
            return;
        }

        if (Hash::check($password, $admin->password)) {
            $this->info("✅ Login credentials are VALID!");
            $this->info("Admin Name: {$admin->name}");
            $this->info("Email: {$admin->email}");
            $this->info("Created: {$admin->created_at}");
        } else {
            $this->error("❌ Password is INCORRECT!");
            $this->info("Admin found but password doesn't match.");
        }

        $this->info("\n🔧 Test login URL: http://127.0.0.1:8000/sudut-potong/admin/login");
    }
}

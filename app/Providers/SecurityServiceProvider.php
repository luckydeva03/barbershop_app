<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Admin;
use App\Policies\UserPolicy;

class SecurityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register policies
        Gate::policy(User::class, UserPolicy::class);

        // Define additional gates
        Gate::define('admin-access', function (?Admin $admin) {
            return $admin !== null;
        });

        Gate::define('manage-users', function (?Admin $admin) {
            return $admin !== null;
        });

        Gate::define('manage-codes', function (?Admin $admin) {
            return $admin !== null;
        });

        Gate::define('manage-reviews', function (?Admin $admin) {
            return $admin !== null;
        });

        // User gates
        Gate::define('user-access', function (?User $user) {
            return $user !== null;
        });

        Gate::define('redeem-codes', function (?User $user) {
            return $user !== null;
        });

        Gate::define('write-reviews', function (?User $user) {
            return $user !== null;
        });

        // Share security info with views
        View::composer('*', function ($view) {
            $view->with([
                'currentAdmin' => auth('admin')->user(),
                'currentUser' => auth('user')->user(),
            ]);
        });
    }
}

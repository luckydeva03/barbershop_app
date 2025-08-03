<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(?Admin $admin): bool
    {
        return $admin !== null;
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(?Admin $admin, User $user): bool
    {
        return $admin !== null;
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(?Admin $admin): bool
    {
        return $admin !== null;
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(?Admin $admin, User $user): bool
    {
        return $admin !== null;
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(?Admin $admin, User $user): bool
    {
        return $admin !== null;
    }

    /**
     * Determine whether the admin can restore the model.
     */
    public function restore(?Admin $admin, User $user): bool
    {
        return $admin !== null;
    }

    /**
     * Determine whether the admin can permanently delete the model.
     */
    public function forceDelete(?Admin $admin, User $user): bool
    {
        return $admin !== null;
    }

    /**
     * Determine whether the admin can manage user points.
     */
    public function managePoints(?Admin $admin, User $user): bool
    {
        return $admin !== null;
    }

    /**
     * Determine whether the user can view their own data.
     */
    public function viewOwn(?User $currentUser, User $user): bool
    {
        return $currentUser && $currentUser->id === $user->id;
    }

    /**
     * Determine whether the user can update their own data.
     */
    public function updateOwn(?User $currentUser, User $user): bool
    {
        return $currentUser && $currentUser->id === $user->id;
    }
}

<?php

namespace App\Policies;

use App\Models\LocalCivilian;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\UserRoles;

class LocalCivilianPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === UserRoles::Admin->value;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LocalCivilian $localCivilian): bool
    {
        return $user->role === UserRoles::Admin->value;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === UserRoles::Admin->value;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LocalCivilian $localCivilian): bool
    {
        return $user->role === UserRoles::Admin->value;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LocalCivilian $localCivilian): bool
    {
        return $user->role === UserRoles::Admin->value;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LocalCivilian $localCivilian): bool
    {
        return $user->role === UserRoles::Admin->value;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LocalCivilian $localCivilian): bool
    {
        return $user->role === UserRoles::Admin->value;
    }
}

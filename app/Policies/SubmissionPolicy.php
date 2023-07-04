<?php

namespace App\Policies;

use App\Models\Submission;
use App\Models\User;
use App\Enums\UserRoles;
use App\Enums\SubmissionStatuses;
use Illuminate\Auth\Access\Response;

class SubmissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Submission $submission): bool
    {
        return ($submission->user->id === $user->id) || ($user->role === UserRoles::Admin->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return ($user->role === UserRoles::User->value) && ($user->role != UserRoles::Admin->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Submission $submission): bool
    {
        return ($submission->user->id === $user->id) || ($user->role === UserRoles::Admin->value) && ($submission->status != SubmissionStatuses::Accepted->value || $submission->status != SubmissionStatuses::Cancelled->value );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Submission $submission): bool
    {
        return ($submission->user->id === $user->id) || ($user->role === UserRoles::Admin->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Submission $submission): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Submission $submission): bool
    {
        //
    }
}

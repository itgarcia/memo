<?php

namespace App\Policies;

use App\Models\Ec;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EcPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRole(['Admin','User']) || $user->hasPermissionTo('Create: OfficeOrder')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ec $ec): bool
    {
        return $user->hasRole(['Admin','User']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ec $ec): bool
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ec $ec): bool
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ec $ec): bool
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ec $ec): bool
    {
        return $user->hasRole('Admin');
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->role ==='project_manager'
        ? Response::allow()
        : Response::deny("You don't have permission to view users");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response
    {
        return $user->role ==='project_manager' || $user->id === $model->id
        ? Response::allow()
        : Response::deny("You don't have permission to view this user");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role ==='project_manager' || $user->role ==='admin' 
        ? Response::allow()
        : Response::deny("You don't have permission to add user");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        return $user->role ==='project_manager' 
        ? Response::allow()
        : Response::deny("You don't have permission to update this user");
        }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        return $user->role ==='project_manager' 
        ? Response::allow()
        : Response::deny("You don't have permission to delete this user");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}

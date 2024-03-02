<?php

namespace App\Policies;

use Illuminate\Support\Facades\Auth;

class RolePolicy
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return  $this->user->role->permissions->pluck('name')->contains('view-any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return $this->user->role->permissions->pluck('name')->contains('view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return $this->user->role->permissions->pluck('name')->contains('create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        return $this->user->role->permissions->pluck('name')->contains('update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return $this->user->role->permissions->pluck('name')->contains('delete');
    }

}

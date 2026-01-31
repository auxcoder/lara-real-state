<?php

namespace App\Policies;

use App\Models\Agents;
use App\Models\User;

class AgentsPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view agents');
    }

    public function view(User $user, Agents $agents): bool
    {
        return $user->hasPermissionTo('view agents');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create agents');
    }

    public function update(User $user, Agents $agents): bool
    {
        return $user->hasPermissionTo('edit agents');
    }

    public function delete(User $user, Agents $agents): bool
    {
        return $user->hasPermissionTo('delete agents');
    }

    public function restore(User $user, Agents $agents): bool
    {
        return $user->hasPermissionTo('delete agents');
    }

    public function forceDelete(User $user, Agents $agents): bool
    {
        return $user->hasPermissionTo('delete agents');
    }
}

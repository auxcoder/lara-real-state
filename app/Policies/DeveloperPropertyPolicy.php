<?php

namespace App\Policies;

use App\Models\DeveloperProperty;
use App\Models\User;

class DeveloperPropertyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view developer properties');
    }

    public function view(User $user, DeveloperProperty $developerProperty): bool
    {
        return $user->hasPermissionTo('view developer properties');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create developer properties');
    }

    public function update(User $user, DeveloperProperty $developerProperty): bool
    {
        return $user->hasPermissionTo('edit developer properties');
    }

    public function delete(User $user, DeveloperProperty $developerProperty): bool
    {
        return $user->hasPermissionTo('delete developer properties');
    }

    public function restore(User $user, DeveloperProperty $developerProperty): bool
    {
        return $user->hasPermissionTo('delete developer properties');
    }

    public function forceDelete(User $user, DeveloperProperty $developerProperty): bool
    {
        return $user->hasPermissionTo('delete developer properties');
    }
}


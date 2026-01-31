<?php

namespace App\Policies;

use App\Models\Developer;
use App\Models\User;

class DeveloperPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view developers');
    }

    public function view(User $user, Developer $developer): bool
    {
        return $user->hasPermissionTo('view developers');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create developers');
    }

    public function update(User $user, Developer $developer): bool
    {
        return $user->hasPermissionTo('edit developers');
    }

    public function delete(User $user, Developer $developer): bool
    {
        return $user->hasPermissionTo('delete developers');
    }

    public function restore(User $user, Developer $developer): bool
    {
        return $user->hasPermissionTo('delete developers');
    }

    public function forceDelete(User $user, Developer $developer): bool
    {
        return $user->hasPermissionTo('delete developers');
    }
}

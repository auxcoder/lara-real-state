<?php

namespace App\Policies;

use App\Models\Community;
use App\Models\User;

class CommunityPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view communities');
    }

    public function view(User $user, Community $community): bool
    {
        return $user->hasPermissionTo('view communities');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create communities');
    }

    public function update(User $user, Community $community): bool
    {
        return $user->hasPermissionTo('edit communities');
    }

    public function delete(User $user, Community $community): bool
    {
        return $user->hasPermissionTo('delete communities');
    }

    public function restore(User $user, Community $community): bool
    {
        return $user->hasPermissionTo('delete communities');
    }

    public function forceDelete(User $user, Community $community): bool
    {
        return $user->hasPermissionTo('delete communities');
    }
}


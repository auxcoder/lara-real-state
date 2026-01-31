<?php

namespace App\Policies;

use App\Models\AgentProperty;
use App\Models\User;

class AgentPropertyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view properties');
    }

    public function view(User $user, AgentProperty $agentProperty): bool
    {
        return $user->hasPermissionTo('view properties');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create properties');
    }

    public function update(User $user, AgentProperty $agentProperty): bool
    {
        return $user->hasPermissionTo('edit properties');
    }

    public function delete(User $user, AgentProperty $agentProperty): bool
    {
        return $user->hasPermissionTo('delete properties');
    }

    public function restore(User $user, AgentProperty $agentProperty): bool
    {
        return $user->hasPermissionTo('delete properties');
    }

    public function forceDelete(User $user, AgentProperty $agentProperty): bool
    {
        return $user->hasPermissionTo('delete properties');
    }
}


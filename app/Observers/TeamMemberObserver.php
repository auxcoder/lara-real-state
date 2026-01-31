<?php

namespace App\Observers;

use App\Models\TeamMember;
use App\Services\CacheService;

class TeamMemberObserver
{
    public function __construct(
        private CacheService $cache
    ) {}

    public function created(TeamMember $teamMember): void
    {
        $this->cache->clearTeamMembers();
    }

    public function updated(TeamMember $teamMember): void
    {
        $this->cache->clearTeamMembers();
    }

    public function deleted(TeamMember $teamMember): void
    {
        $this->cache->clearTeamMembers();
    }
}

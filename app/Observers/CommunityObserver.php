<?php

namespace App\Observers;

use App\Models\Community;
use App\Services\CacheService;

class CommunityObserver
{
    public function __construct(
        private CacheService $cache
    ) {}

    public function created(Community $community): void
    {
        $this->cache->clearCommunities();
    }

    public function updated(Community $community): void
    {
        $this->cache->clearCommunities();
    }

    public function deleted(Community $community): void
    {
        $this->cache->clearCommunities();
    }

    public function restored(Community $community): void
    {
        $this->cache->clearCommunities();
    }
}

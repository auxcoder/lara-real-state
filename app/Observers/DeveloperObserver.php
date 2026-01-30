<?php

namespace App\Observers;

use App\Models\Developer;
use App\Services\CacheService;

class DeveloperObserver
{
    public function __construct(
        private CacheService $cache
    ) {}

    public function created(Developer $developer): void
    {
        $this->cache->clearDevelopers();
    }

    public function updated(Developer $developer): void
    {
        $this->cache->clearDevelopers();
    }

    public function deleted(Developer $developer): void
    {
        $this->cache->clearDevelopers();
    }

    public function restored(Developer $developer): void
    {
        $this->cache->clearDevelopers();
    }
}

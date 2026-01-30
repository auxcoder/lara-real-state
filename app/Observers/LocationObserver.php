<?php

namespace App\Observers;

use App\Models\Location;
use App\Services\CacheService;

class LocationObserver
{
    public function __construct(
        private CacheService $cache
    ) {}

    public function created(Location $location): void
    {
        $this->cache->clearLocations();
    }

    public function updated(Location $location): void
    {
        $this->cache->clearLocations();
    }

    public function deleted(Location $location): void
    {
        $this->cache->clearLocations();
    }
}

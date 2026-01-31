<?php

namespace App\Observers;

use App\Models\Amenity;
use App\Services\CacheService;

class AmenityObserver
{
    public function __construct(
        private CacheService $cache
    ) {}

    public function created(Amenity $amenity): void
    {
        $this->cache->clearAmenities();
    }

    public function updated(Amenity $amenity): void
    {
        $this->cache->clearAmenities();
    }

    public function deleted(Amenity $amenity): void
    {
        $this->cache->clearAmenities();
    }

    public function restored(Amenity $amenity): void
    {
        $this->cache->clearAmenities();
    }
}

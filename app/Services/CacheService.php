<?php

namespace App\Services;

use App\Models\Amenity;
use App\Models\Community;
use App\Models\Developer;
use App\Models\Location;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    private const TTL = 3600; // 1 hour

    public function getLocations()
    {
        return Cache::remember('locations.all', self::TTL, fn() => Location::all());
    }

    public function getCommunities()
    {
        return Cache::remember('communities.all', self::TTL, fn() => Community::all());
    }

    public function getDevelopers()
    {
        return Cache::remember('developers.all', self::TTL, fn() => Developer::all());
    }

    public function getAmenities()
    {
        return Cache::remember('amenities.all', self::TTL, fn() => Amenity::all());
    }

    public function getTeamMembers()
    {
        return Cache::remember('team_members.all', self::TTL, fn() => TeamMember::all());
    }

    public function clearLocations(): void
    {
        Cache::forget('locations.all');
    }

    public function clearCommunities(): void
    {
        Cache::forget('communities.all');
    }

    public function clearDevelopers(): void
    {
        Cache::forget('developers.all');
    }

    public function clearAmenities(): void
    {
        Cache::forget('amenities.all');
    }

    public function clearTeamMembers(): void
    {
        Cache::forget('team_members.all');
    }

    public function getAgentProperties(int $perPage = 5)
    {
        $page = request()->get('page', 1);
        return Cache::remember("agent_properties.page.{$page}", self::TTL, function() use ($perPage) {
            return \App\Models\AgentProperty::with(['agent:id,name', 'translations'])
                ->select('id', 'agent_id', 'name', 'price', 'bedrooms', 'bathrooms', 'area', 'image', 'slug')
                ->paginate($perPage);
        });
    }

    public function getDeveloperProperties(int $perPage = 5)
    {
        $page = request()->get('page', 1);
        return Cache::remember("developer_properties.page.{$page}", self::TTL, function() use ($perPage) {
            return \App\Models\DeveloperProperty::with(['developer:id,name', 'propertyTypes:id,name', 'locations:id,name'])
                ->paginate($perPage);
        });
    }

    public function clearProperties(): void
    {
        Cache::flush(); // Clear all property caches (simple approach)
    }
}

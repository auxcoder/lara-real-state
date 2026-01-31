<?php

namespace App\Providers;

use App\Models\Amenity;
use App\Models\Community;
use App\Models\Developer;
use App\Models\Location;
use App\Models\TeamMember;
use App\Observers\AmenityObserver;
use App\Observers\CommunityObserver;
use App\Observers\DeveloperObserver;
use App\Observers\LocationObserver;
use App\Observers\TeamMemberObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // This is the line that registers your custom layout path:
        Blade::componentNamespace('App\\View\\Layouts', 'layout');

        // Register observers for cache invalidation
        Location::observe(LocationObserver::class);
        Community::observe(CommunityObserver::class);
        Developer::observe(DeveloperObserver::class);
        Amenity::observe(AmenityObserver::class);
        TeamMember::observe(TeamMemberObserver::class);
    }
}

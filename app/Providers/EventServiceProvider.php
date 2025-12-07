<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        if ($this->app->environment('local', 'testing')) {
            Event::listen(
                MigrationsEnded::class,
                function () {
                    // Generates the model annotations after a migration is finished.
                    // -R: Refresh annotations
                    // -W: Write annotations directly to the model file
                    Artisan::call('ide-helper:models -R -W');

                    // Optional: You may also want to generate the main facade helper file
                    Artisan::call('ide-helper:generate');
                }
            );
        }
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

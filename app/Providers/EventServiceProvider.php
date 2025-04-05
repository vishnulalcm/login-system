<?php

namespace App\Providers;

use App\Events\UserSaved;
use App\Listeners\SaveUserBackgroundInformation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
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

        // Register our UserSaved event and its listener
        UserSaved::class => [
            SaveUserBackgroundInformation::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // You can also register events here using the Event facade if needed
        // Event::listen(...);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

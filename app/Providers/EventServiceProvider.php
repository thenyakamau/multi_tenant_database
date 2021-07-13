<?php

namespace App\Providers;

use App\Events\CreateProjectDatabase;
use App\Events\DataBaseCreated;
use App\Listeners\CreateProjectDatabaseListener;
use App\Listeners\DataBaseCreatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateProjectDatabase::class => [
            CreateProjectDatabaseListener::class
        ],
        DataBaseCreated::class => [
            DataBaseCreatedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Models\Company;
use App\Observers\CompanyObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Company::class => [CompanyObserver::class],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Observer is registered in $observers property
    }
}
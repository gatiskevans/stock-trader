<?php

namespace App\Providers;

use App\Events\StockPurchasedEvenet;
use App\Events\StockPurchasedEvent;
use App\Events\StockSoldEvent;
use App\Listeners\StockPurchasedListener;
use App\Listeners\StockSoldListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        StockPurchasedEvent::class => [
            StockPurchasedListener::class
        ],
        StockSoldEvent::class => [
            StockSoldListener::class
        ]
    ];

    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\VendorSubscriptionExpiringEvent;
use App\Events\VendorSubscriptionExpiredEvent;
use App\Listeners\SendVendorSubscriptionNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        VendorSubscriptionExpiringEvent::class => [
            SendVendorSubscriptionNotification::class,
        ],
        VendorSubscriptionExpiredEvent::class => [
            SendVendorSubscriptionNotification::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}

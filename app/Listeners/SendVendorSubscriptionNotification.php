<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\VendorSubscriptionExpiringEvent;
use App\Events\VendorSubscriptionExpiredEvent;
use App\Notifications\VendorSubscriptionNotification;

class SendVendorSubscriptionNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $subscription = $event->subscription;
        $vendor_representatives = $subscription->vendor->vendor_representatives;

        foreach($vendor_representatives as $one_representer)
        {
            if($event instanceof VendorSubscriptionExpiringEvent)
            {

                $one_representer->user->notify(
                    new VendorSubscriptionNotification($subscription,"expiring")
                );
            }

            if($event instanceof VendorSubscriptionExpiredEvent)
            {
                $one_representer->user->notify(
                    new VendorSubscriptionNotification($subscription,"expired")
                );
            }
        }

    }
}

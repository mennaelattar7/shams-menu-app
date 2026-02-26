<?php

namespace App\Listeners;

use App\Events\CustomerSendTableRequestEvent;
use App\Notifications\CustomerSendTableRequestNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CustomerSendTableRequestListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CustomerSendTableRequestEvent $event): void
    {
        $table_request = $event->table_request;
        $vendor = $table_request->table->branch->vendor;
        $vendor_representatives = $vendor->vendor_representatives;
        foreach($vendor_representatives as $one_represent)
        {
            $user = $one_represent->user;
            if($user->activation_status == "active" && $user->account_status == "approved")
            {
                $user->notify(new CustomerSendTableRequestNotification($event->table_request));
            }

        }
    }
}

<?php

namespace App\Listeners;

use App\Events\CustomerSendTableRequestEvent;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
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
        $roles =Role::query()
            ->whereHas('permissions', function ($q) {
                $q->where('name', '9_notify_vendor_branch___table_request')
                ->where('guard_name', 'api');
            })
            ->get();

        if($roles)
        {
            foreach($roles as $one_role)
            {
                if($one_role->position)
                {
                    $employees = $one_role->position->employees->where('vendor_id',$vendor->id);
                    foreach($employees as $one_employee)
                    {
                        $user = $one_employee->user;
                        if($user->activation_status == "active" && $user->account_status == "approved")
                        {
                            $user->notify(new CustomerSendTableRequestNotification($event->table_request));
                        }
                    }
                }
            }

        }
    }
}

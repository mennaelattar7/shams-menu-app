<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Vendor__PackegeSubscription;
use App\Events\VendorSubscriptionExpiringEvent;
use App\Events\VendorSubscriptionExpiredEvent;

class CheckVendorSubscriptions extends Command
{
    protected $signature = 'subscriptions:check';

    protected $description = 'Check vendor package subscriptions';

    public function handle()
    {

        $now = Carbon::now();

        // الاشتراكات اللي قربت تنتهي (قبل يوم)
        $expiringSubscriptions = Vendor__PackegeSubscription::where('status','active')
            ->where('expiring_notification_sent', 'false')
            ->whereBetween('end_at', [
                Carbon::now(),
                Carbon::now()->addDays(3)
            ])
            ->get();

        foreach ($expiringSubscriptions as $subscription)
        {
            event(new VendorSubscriptionExpiringEvent($subscription));
            $subscription->expiring_notification_sent = 'true';
            $subscription->save();
        }


        // الاشتراكات المنتهية
        $expiredSubscriptions = Vendor__PackegeSubscription::where('status','active')
            ->where('expired_notification_sent', 'false')
            ->where('end_at','<=',$now)
            ->get();

        foreach ($expiredSubscriptions as $subscription)
        {
            $subscription->expired_notification_sent = 'true';
            $subscription->status = 'expired';
            $subscription->save();

            event(new VendorSubscriptionExpiredEvent($subscription));
        }

    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorSubscriptionNotification extends Notification
{

    protected $type;
    protected $subscription;

    public function __construct($subscription,$type)
    {
        $this->subscription = $subscription;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
     public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        if($this->type == "expiring")
        {
            $message = "Your package subscription will expire soon. Please renew.";
        }
        else
        {
            $message = "Your package subscription has expired.";
        }

        return [
            'title' => 'قرب انتهاء الاشتراك',
            'message' => 'اشتراكك سينتهي خلال 3 ايام يرجي تجديد الاشتراك لتجنب ايقاف الخدمه',
            'vendor_id' => $this->subscription->vendor_id,
            'subscription_id' => $this->subscription->id,
            'message' => $message
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

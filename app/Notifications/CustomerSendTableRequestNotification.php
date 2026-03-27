<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerSendTableRequestNotification extends Notification
{
    use Queueable;

    protected $table_request;
    public function __construct($table_request)
    {
        $this->table_request = $table_request;
    }

    // هنخزن في الداتابيز بس
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {

        return [
            'customer' => $this->table_request?->customer?->user?->name,
            'table_number' => $this->table_request->table->table_number,
            'notification_type' => 'services',
            'request_type' => $this->table_request->request_type,
            'notes' =>$this->table_request->notes,
            'current_status' =>$this->table_request->current_status,
            'requested_at' =>$this->table_request->requested_at
        ];
    }
}

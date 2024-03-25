<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PickupRequestReceivedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $customData;
    public function __construct($customData)
    {
        //
        $this->customData = $customData;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        
        return (new MailMessage)
            ->view('emails.admin_pickup_request', ['name' => $this->customData['name'], 'message' => $this->customData['message']]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new pickup request has been received.',
            'data' => $this->customData, // If you want to include pickup request ID
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
                'message'=>$this->customData['message'],
              ];
    }
}

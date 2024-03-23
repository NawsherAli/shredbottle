<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClaimBalanceRequestCompletedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
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
        ->view('emails.claim_balance_request_completed', [
            'name' => $this->customData['name'],
            'request_id' => $this->customData['request_id'],
            'amount' => $this->customData['amount'],
            'transaction_no' => $this->customData['transaction_no'],
            'date' => $this->customData['date'],
            'e_transfer_no' => $this->customData['e_transfer_no']]);
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
        ];;
    }
}

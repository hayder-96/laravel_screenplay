<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\TicketEntry;
use Illuminate\Notifications\Messages\NexmoMessage;

class notify extends Notification
{
    use Queueable;

//     protected $entry;

//     public function __construct(TicketEntry $entry)
//     {
//         $this->entry = $entry;
//     }
//     public function via($notifiable)
//     {
//         return ['nexmo'];
//     }

   
//     public function toMail($notifiable)
//     {
//         return (new MailMessage)
//                     ->line('The introduction to the notification.')
//                     ->action('Notification Action', url('/'))
//                     ->line('Thank you for using our application!');
//     }

//     public function toNexmo($notifiable)
// {
//     return (new NexmoMessage)
//         ->content($this->entry->content);
// }





//     public function toArray($notifiable)
//     {
//         return [
//             //
//         ];
//     }
}

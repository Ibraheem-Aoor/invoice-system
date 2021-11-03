<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;


class NewUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    /* Start Attributes */
        public $title ,
                $body ,
                $id; //for the user or the whatEver.
    /* End Attributes */

    public function __construct($info)
    {
        $this->title = $info[0];
        $this->body = 'انضم '.$info[1].' إالى قائمة المستخدمين لديك! ';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */


    /*
        -Each Notification have a title , body , and date to appear to the user
    */

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            // 'id' => $this->id,
        ];
    }


    public function toArray($notifiable)
    {
        return [

        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
Use DB;

class UserResetPasswordNotification extends Notification
{
    use Queueable;
    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token=$token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
//        dd($notifiable);
       // dd((new MailMessage)->from('iandancun@gmail.com', ['Project Team']));
        if($notifiable->hasRole('coordinator')){

            return (new MailMessage)
                ->greeting('Hello,'. $notifiable->name )
                ->line('You are receiving this email because we received a password reset request for your account.')
                ->action('Reset Password', route('admin.reset',$this->token))
                ->line('If You did not request a password reset, no further action is required!');
        }
        if($notifiable->hasRole('student')){

            return (new MailMessage)
//                ->from('iandancun@gmail.com','Project Team')
                ->greeting('Hello, '. $notifiable->name )
                ->line('You are receiving this email because we received a password reset request for your account.')
                ->action('Reset Password', route('student.reset',$this->token))
                ->line('If You did not request a password reset, no further action is required!');
        }
        if($notifiable->hasRole('supervisor')){
            return (new MailMessage)
                ->subject('Project Management System Team')
                ->greeting('Hello, '. $notifiable->name )
                ->line('You are receiving this email because we received a password reset request for your account.')
                ->action('Reset Password', route('supervisor.reset',$this->token))
                ->line('If You did not request a password reset, no further action is required!');
        }


    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

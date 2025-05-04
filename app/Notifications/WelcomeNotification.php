<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome to Our Hospital')
            ->line('Welcome to our hospital management system!')
            ->line('We are glad to have you on board.')
            ->line('You can now book appointments and manage your health records with us.')
            ->line('If you have any questions, feel free to contact us.')
            ->line('Thank you for choosing our hospital!');
    }
} 
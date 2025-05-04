<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Appointment Reminder')
            ->line('This is a reminder for your upcoming appointment.')
            ->line('Date: ' . $this->appointment->appointment_date)
            ->line('Time: ' . $this->appointment->appointment_time)
            ->line('Doctor: ' . $this->appointment->doctor->name)
            ->line('Please arrive 15 minutes before your scheduled time.')
            ->line('If you need to reschedule or cancel, please contact us as soon as possible.');
    }
} 
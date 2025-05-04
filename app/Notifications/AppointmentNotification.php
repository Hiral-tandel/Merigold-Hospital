<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentNotification extends Notification implements ShouldQueue
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
            ->subject('Appointment Confirmation')
            ->line('Dear ' . $this->appointment['patient_name'] . ',')
            ->line('Your appointment has been scheduled for ' . $this->appointment['appointment_date'] . ' at ' . $this->appointment['appointment_time'])
            ->line('Reason for visit: ' . $this->appointment['reason'])
            ->line('Status: ' . ucfirst($this->appointment['status']))
            ->line('We will contact you for further confirmation.')
            ->line('Thank you for choosing our hospital!');
    }
} 
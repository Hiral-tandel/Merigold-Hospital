<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentStatusNotification extends Notification implements ShouldQueue
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
        $message = (new MailMessage)
            ->subject('Appointment Status Update')
            ->line('Your appointment status has been updated.');

        switch ($this->appointment->status) {
            case 'confirmed':
                $message->line('Your appointment has been confirmed.')
                    ->line('Date: ' . $this->appointment->appointment_date)
                    ->line('Time: ' . $this->appointment->appointment_time)
                    ->line('Doctor: ' . $this->appointment->doctor->name);
                break;
            case 'cancelled':
                $message->line('Your appointment has been cancelled.')
                    ->line('If you did not request this cancellation, please contact us immediately.');
                break;
            case 'completed':
                $message->line('Your appointment has been marked as completed.')
                    ->line('Thank you for choosing our hospital for your healthcare needs.');
                break;
            default:
                $message->line('Your appointment status is now: ' . ucfirst($this->appointment->status));
        }

        return $message;
    }
} 
<?php

namespace App\Mail;

use App\Models\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DoctorWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $doctor;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct(Doctor $doctor, string $password)
    {
        $this->doctor = $doctor;
        $this->password = $password;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('emails.doctor-welcome')
                    ->subject('Welcome to Our Hospital Team');
    }
} 
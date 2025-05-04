<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Notifications\AppointmentReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendAppointmentReminders extends Command
{
    protected $signature = 'appointments:send-reminders';
    protected $description = 'Send reminder notifications for upcoming appointments';

    public function handle()
    {
        // Get appointments scheduled for tomorrow
        $appointments = Appointment::with(['patient', 'doctor'])
            ->where('appointment_date', Carbon::tomorrow()->format('Y-m-d'))
            ->where('status', 'confirmed')
            ->get();

        foreach ($appointments as $appointment) {
            // Send reminder notification to patient
            $appointment->patient->notify(new AppointmentReminderNotification($appointment));
            
            $this->info("Reminder sent for appointment ID: {$appointment->id}");
        }

        $this->info('Appointment reminders sent successfully!');
    }
} 
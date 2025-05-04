<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\SendAppointmentReminders::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Run appointment reminders daily at 9 AM
        $schedule->command('appointments:send-reminders')
                ->dailyAt('09:00')
                ->withoutOverlapping();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
} 
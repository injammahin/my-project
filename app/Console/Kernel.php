<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Aggregate analytics every 10 minutes
        $schedule->command('analytics:aggregate')->everyTenMinutes();

        // Clean old raw events daily
        $schedule->call(function () {
            \App\Models\VisitorEvent::where(
                'created_at','<',now()->subDays(90)
            )->delete();
        })->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}

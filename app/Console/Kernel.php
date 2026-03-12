<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\AggregateVisitorEvents;
use App\Models\VisitorEvent;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // 🔁 Aggregate visitor events every hour
        $schedule->job(new AggregateVisitorEvents)
            ->hourly()
            ->withoutOverlapping()
            ->onOneServer();

        // 🧹 Clean raw events older than 7 days
        $schedule->call(function () {
            VisitorEvent::where('created_at', '<', now()->subDays(7))->delete();
        })->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VisitorEvent;
use App\Models\EventStat;
use Illuminate\Support\Facades\DB;

class AggregateVisitorEvents extends Command
{
    protected $signature = 'analytics:aggregate';
    protected $description = 'Aggregate visitor events into stats';

    public function handle()
    {
        $events = VisitorEvent::where('created_at', '>=', now()->subMinutes(10))
            ->get()
            ->groupBy(function ($e) {
                return
                    $e->created_at->toDateString().'|'.
                    $e->event.'|'.
                    ($e->page ?? '');
            });

        foreach ($events as $group) {
            $first = $group->first();

            EventStat::updateOrCreate(
                [
                    'date' => $first->created_at->toDateString(),
                    'event' => $first->event,
                    'page' => $first->page,
                ],
                [
                    'count' => DB::raw('count + '.$group->count()),
                    'total_seconds' => DB::raw(
                        'total_seconds + '.$group->sum(fn($e) => $e->data['seconds'] ?? 0)
                    ),
                ]
            );
        }

        $this->info('Analytics aggregated successfully.');
    }
}

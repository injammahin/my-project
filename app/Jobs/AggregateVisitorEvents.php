<?php

namespace App\Jobs;

use App\Models\VisitorEvent;
use App\Models\EventStat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class AggregateVisitorEvents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        VisitorEvent::selectRaw('
                DATE(created_at) as date,
                event,
                page,
                COUNT(*) as total_count,
                SUM(
                    CASE
                        WHEN JSON_VALID(data)
                        THEN COALESCE(JSON_EXTRACT(data, "$.seconds"), 0)
                        ELSE 0
                    END
                ) as total_seconds
            ')
            ->groupBy('date', 'event', 'page')
            ->orderBy('date')
            ->chunk(500, function ($rows) {

                foreach ($rows as $row) {

                    $stat = EventStat::firstOrNew([
                        'date'  => $row->date,
                        'event' => $row->event,
                        'page'  => $row->page,
                    ]);

                    // Safe increment
                    $stat->count = ($stat->count ?? 0) + $row->total_count;
                    $stat->total_seconds = ($stat->total_seconds ?? 0) + ($row->total_seconds ?? 0);

                    $stat->save();
                }
            });

        // 🧹 Clean old raw events (keep only last 7 days)
        VisitorEvent::where('created_at', '<', now()->subDays(7))->delete();
    }
}

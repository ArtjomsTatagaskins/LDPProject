<?php

namespace App\Console\Commands;

use App\Jobs\UpdatePipelineStatistics;
use Illuminate\Console\Command;

class UpdatePipelineStatsCommand extends Command
{
    protected $signature = 'stats:update';

    protected $description = 'Update GitLab pipeline statistics for all ranges';

    public function handle()
    {
        $ranges = ['day', 'week', 'month'];
        foreach ($ranges as $range) {
            UpdatePipelineStatistics::dispatch($range);
            $this->info("Dispatched job for range: {$range}");
        }
        return 0;
    }
}

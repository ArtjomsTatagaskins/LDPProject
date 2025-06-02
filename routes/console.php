<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\UpdatePipelineStatsCommand;

Artisan::command('stats:update', function () {
    $this->call(UpdatePipelineStatsCommand::class);
});

app(Schedule::class)->command('stats:update')->everyMinute();

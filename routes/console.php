<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('monitor', function () {
    $this->info("Monitor command started.");
    Artisan::call('db:monitor', ['--max' => 100]);
    $output = Artisan::output();
    $this->info($output);

    $this->info('Monitor command finished.');
});

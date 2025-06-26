<?php

namespace App\Console;

use App\Console\Commands\MakeService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        MakeService::class
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Schedule your Artisan commands here
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

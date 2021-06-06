<?php

namespace App\Console;

use App\Console\Commands\InitCommand;
use App\Console\Commands\ScheduleKeywordCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package App\Console
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ScheduleKeywordCommand::class,
        InitCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // trigger at mid night.
        /*
         * At a first of day. This command will be triggered by crontabs.
         * it read keywords and push back to queue and then collect info from google and store to db
         */
        $schedule->command('schedule:keyword')->daily();
    }
}

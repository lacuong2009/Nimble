<?php

namespace App\Console\Commands;

use App\Services\FileService;
use Illuminate\Console\Command;

/**
 * Class ScheduleKeywordCommand
 * @package App\Entities
 */
class ScheduleKeywordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:keyword';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run schedule to get data of keyword from google';

    /**
     * @param FileService $service
     */
    public function handle(FileService $service)
    {
        $service->scheduleKeyword();
    }
}

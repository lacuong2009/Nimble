<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'init data';

    /**
     *
     */
    public function handle()
    {
        sleep(5);
        Artisan::call('migrate');
        (new \OauthClientsSeeder())->run();
        (new \UserSeeder())->run();
    }
}
